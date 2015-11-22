<?php

class Page {
    private $name;
    private $desc;
    private $title;
    private $page;

    public function __construct($name, $desc, $title, $page) {
        $this->name = $name;
        $this->desc = $desc;
        $this->title = $title;
        $this->page = $page;

    }

    /**
     * @param User $user
     * @return Page[]
     */
    public static function getPages(User $user) {
        global $mysqli;

        $pages = array();

        $query = $mysqli->query("SELECT * FROM pages ORDER BY id");
        while ($result = $query->fetch_array()) {
            if (
                ($result['clearance'] > 0 && $user->getClearance() && $user->getClearance()->getClearance() >= $result['clearance']) ||
                ($result['admin'] > 0 && $result['team'] != 0 && (($user->getAdmin() && $user->getAdmin()->getAdminLevel() >= $result['admin'] && in_array(new Division($result['team']), $user->getAdmin()->getTeams())) || ($user->getAdmin() && $user->getAdmin()->getAdminLevel() > $result['admin'] + 1)) || ($user->getAdmin() && $user->getAdmin()->getAdminLevel() > 3)) ||
                ($user->getAdmin() && $user->getAdmin()->getAdminLevel() >= $result['admin'] && $result['team'] == 0) ||
                ($result['clearance'] == 0 && $result['admin'] == 0)
            ) {
                $pages[] = new self($result['name'], $result['desc'], $result['title'], $result['page']);
            }
        }

        return $pages;
    }

    public function getName() {
        return $this->name;
    }

    public function getDesc() {
        return $this->desc;
    }

    public function getTitle() {
        return $this->title;
    }

    public function getPage() {
        return $this->page;
    }
}