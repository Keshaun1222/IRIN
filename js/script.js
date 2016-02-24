function load(page, action, doParam, params) {
    var active = $("#lastactive").val();
    var now = (new Date()).getTime();

    if (active != '' && Math.floor((now - active) / 3600000) >= 2) {
        $('#main').load('logout.php?action=logout');
    } else {
        var others = '';
        for (var i in params) {
            others += '&' + i + '=' + params[i];
        }

        $.ajax({
            type: "POST",
            url: "setsession.php?time=" + now,
            success: function() {}
        });

        $('#main').load(page + '.php?action=' + action + '&do=' + doParam + others);
        /*$('#' + page + 'Collapse .panel-body').html('Action: ' + action);
         $('.panel-collapse:not(#' + page + 'Collapse)').collapse('hide');
         $('#' + page + 'Collapse').collapse('show');*/
        $('.panel-heading:not(#' + page + ') a').removeClass('current');
        $('#' + page + ' a').addClass('current');
        $('#lastactive').val(now);
    }
}

function changePassword() {
    var password = $("#password").val();
    var confpass1 = $("#confpass1").val();
    var confpass2 = $("#confpass2").val();
    $.ajax({
        type: "POST",
        url: "info.php?action=pass&do=change",
        data: "password=" + password + "&confpass1=" + confpass1 + "&confpass2=" + confpass2,
        success: function(html) {
            if (html == 'true') {
                load('info', 'none', 'none', {});
            } else {
                $("#error").html(html).show();
            }
        }, beforeSend: function() {
            $("#error").html("Loading...").show();
        }
    });
}

function createPCR() {
    var pcrNum = $("#pcrNum").val();
    var minorPCR = $("#minorPCR").val();
    var text = $("#text").val();
    $.ajax({
        type: "POST",
        url: "devworklog.php?action=new&do=add",
        data: "pcrNum=" + pcrNum + "&minorPCR=" + minorPCR + "&text=" + text,
        success: function() {
            load('devworklog', 'none', 'none', {});
        }, beforeSend: function() {
            $("#loading").html("Loading...").show();
        }
    });
}

function editPCR() {
    var id = $("#id").val();
    var pcrNum = $("#pcrNum").val();
    var minorPCR = $("#minorPCR").val();
    var text = $("#text").val();
    $.ajax({
        type: "POST",
        url: "devworklog.php?action=edit&do=edit",
        data: "id=" + id + "&pcrNum=" + pcrNum + "&minorPCR=" + minorPCR + "&text=" + text,
        success: function() {
            load('devworklog', 'none', 'none', {});
        }, beforeSend: function() {
            $("#loading").html("Loading...").show();
        }
    });
}

function assignPCR() {
    var id = $("#id").val();
    var assigned = $("#assigned").val();
    var text = $("#text").val();
    $.ajax({
        type: "POST",
        url: "devworklog.php?action=assign&do=assign&id=" + id,
        data: "assigned=" + assigned,
        success: function() {
            load('devworklog', 'none', 'none', {});
        }, beforeSend: function() {
            $("#loading").html("Loading...").show();
        }
    });
}

function addAssignee() {
    var assignees = $("#assignees").val();
    var assign = $("#assign").val();
    var data = '';
    var newVal = '';

    if (assignees == '') {
        data = "assign=" + assign;
        newVal = assign;
    } else {
        data = "assignees=" + assignees + "&assign=" + assign;
        newVal = assignees + ',' + assign;
    }

    $.ajax({
        type: "POST",
        url: "documents.php?action=new&do=add",
        data: data,
        success: function(html) {
            $("#assignees").val(newVal);
            $("#assigneen").html(html);
        }
    });
}

function clearAssignees() {
    $("#assignees").val('');
    $("#assigneen").html('');
}

function createDoc() {
    var assignees = $("#assignees").val();
    var subject = $("#subject").val();
    var clearance = $("#clearance").val();
    var prefix = $("#prefix").val();
    var body = encodeURIComponent($("#body").val());
    $.ajax({
        type: "POST",
        url: "documents.php?action=new&do=create",
        data: "subject=" + subject + "&clearance=" + clearance + "&prefix=" + prefix + "&body=" + body + "&assignees=" + assignees,
        success: function(html) {
            load('documents', 'view', 'none', {id: html});
        }, beforeSend: function () {
            $("#loading").html("Loading...").show();
        }
    });
}

function editDoc() {
    var id = $("#id").val();
    var assignees = $("#assignees").val();
    var status = $("#status").val();
    var subject = $("#subject").val();
    var clearance = $("#clearance").val();
    var prefix = $("#prefix").val();
    var body = $("#body").val();
    $.ajax({
        type: "POST",
        url: "documents.php?action=edit&do=edit&id=" + id,
        data: "subject=" + subject + "&status=" + status + "&clearance=" + clearance + "&prefix=" + prefix + "&body=" + body + "&assignees=" + assignees,
        success: function() {
            load('documents', 'view', 'none', {id: id});
        }, beforeSend: function () {
            $("#loading").html("Loading...").show();
        }
    });
}

function searchDoc() {
    var searchid = $("#searchid").val();
    $.ajax({
        type: "POST",
        url: "documents.php?action=search&do=search",
        data: "searchid=" + searchid,
        success: function(html) {
            if (html == 'true') {
                var newID = searchid.substr(1);
                load('documents', 'view', 'none', {id: newID});
            } else {
                $("#loading").html(html).show();
            }
        }, beforeSend: function() {
            $("#loading").html("Loading...").show();
        }
    });
}

function createRank() {
    var name = $("#name").val();
    var abbrev = $("#abbrev").val();
    var paygrade = $("#paygrade").val();
    var division = $("#division").val();
    $.ajax({
        type: "POST",
        url: "ranks.php?action=create&do=create",
        data: "name=" + name + "&abbrev=" + abbrev + "&paygrade=" + paygrade + "&division=" + division,
        success: function() {
            load('ranks', 'none', 'none', {});
        }, beforeSend: function() {
            $("#loading").html("Loading...").show();
        }
    });
}

function editRank() {
    var id = $("#id").val();
    var name = $("#name").val();
    var abbrev = $("#abbrev").val();
    var paygrade = $("#paygrade").val();
    var division = $("#division").val();
    $.ajax({
        type: "POST",
        url: "ranks.php?action=edit&do=edit&id=" + id,
        data: "name=" + name + "&abbrev=" + abbrev + "&paygrade=" + paygrade + "&division=" + division,
        success: function() {
            load('ranks', 'none', 'none', {});
        }, beforeSend: function() {
            $("#loading").html("Loading...").show();
        }
    });
}

function createUser() {
    var login = $("#login").val();
    var email = $("#email").val();
    var division = $("#division").val();
    var clearance = $("#clearance").val();
    var name = $("#name").val();
    var rank = $("#rank").val();
    $.ajax({
        type: "POST",
        url: "users.php?action=new&do=create",
        data: "login=" + login + "&email=" + email + "&clearance=" + clearance + "&division=" + division + "&name=" + name + "&rank=" + rank,
        success: function(html) {
            if (html == 'true') {
                load('users', 'none', 'none', {});
            } else {
                $("#error").html(html).show();
            }
        }, beforeSend: function () {
            $("#error").html("Loading...").show();
        }
    });
}

function editUser() {
    var id = $("#id").val();
    var login = $("#login").val();
    var email = $("#email").val();
    var division = $("#division").val();
    var clearance = $("#clearance").val();
    var name = $("#name").val();
    var rank = $("#rank").val();
    var divcommand = $("#divcommand").val();
    $.ajax({
        type: "POST",
        url: "users.php?action=edit&do=edit&id=" + id,
        data: "login=" + login + "&email=" + email + "&clearance=" + clearance + "&division=" + division + "&name=" + name + "&rank=" + rank + "&divcommand=" + divcommand,
        success: function() {
            load('users', 'none', 'none', {});
        }, beforeSend: function () {
            $("#loading").html("Loading...").show();
        }
    });
}

function generateCode() {
    var purpose = $("#purpose").val();
    $.ajax({
        type: "POST",
        url: "codegen.php?action=generate&do=none",
        data: "purpose=" + purpose,
        success: function(html) {
            //$("#code").html(html);
            load('codegen', 'none', 'none', {});
        }
    });
}

function editMerits() {
    var id = $("#id").val();
    var merits = $("#merits").val();
    $.ajax({
        type: "POST",
        url: "meritdb.php?action=edit&do=edit&id=" + id,
        data: "merits=" + merits,
        success: function() {
            load('meritdb', 'none', 'none', {});
        }, beforeSend: function() {
            $("#loading").html("Loading...").show();
        }
    });
}

function createVersion() {
    var version = $("#vers").val();
    var ver = $("#ver").val();
    $.ajax({
        type: "POST",
        url: "version.php?action=add&do=add",
        data: "version=" + version + "&ver=" + ver,
        success: function() {
            load('version', 'none', 'none', {});
        }, beforeSend: function() {
            $("#loading").html("Loading...").show();
        }
    });
}

function createYear() {
    var year = $("#year").val();
    var era = $("#era").val();
    $.ajax({
        type: "POST",
        url: "irclockup.php?action=add&do=add",
        data: "year=" + year + "&era=" + era,
        success: function() {
            load('irclockup', 'none', 'none', {});
        }, beforeSend: function() {
            $("#loading").html("Loading...").show();
        }
    });
}

function createAdmin() {
    var dataString = $("#form").serialize();

    $.ajax({
        type: "POST",
        url: "admin.php?action=add&do=add",
        data: dataString,
        success: function(html) {
            if (html == 'true') {
                load('admin', 'none', 'none', {});
            } else {
                $("#error").html(html).show();
            }
        }
    });
}

function editAdmin(id) {
    var dataString = $("#form").serialize();

    $.ajax({
        type: "POST",
        url: "admin.php?action=edit&do=edit&id=" + id,
        data: dataString,
        success: function(html) {
            if (html == 'true') {
                load('admin', 'none', 'none', {});
            } else {
                $("#error").html(html).show();
            }
        }
    });
}

function editAdmin(id) {
    var dataString = $("#form").serialize();

    $.ajax({
        type: "POST",
        url: "admin.php?action=edit&do=edit&id=" + id,
        data: dataString,
        success: function(html) {
            if (html == 'true') {
                load('admin', 'none', 'none', {});
            } else {
                $("#error").html(html).show();
            }
        }
    });
}

function editAwards(id) {
    var dataString = $("#form").serialize();

    $.ajax({
        type: "POST",
        url: "awards.php?action=edit&do=edit&id=" + id,
        data: dataString,
        success: function(html) {
            //$("#test").html(html);
            load('awards', 'view', 'view', {id: id});
        }
    });
}

function disableCheckBox() {
    var value = $("#primary").val();
    $(".others").removeAttr("disabled");
    if (value != '')
        $(".others[value=" + value + "]").attr("disabled", true);
}

$(document).ready(function() {
    $('#main').load('home.php');
    $('.panel-collapse').collapse({
        toggle: false
    });
    $('#home a').addClass('current');
    //$('#lastactive').val((new Date()).getTime());
});