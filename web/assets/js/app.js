function getFormattedDate(dateString){
    var monthNames = ["January", "February", "March", "April", "May", "June",
        "July", "August", "September", "October", "November", "December"
    ];

    var d = new Date(dateString);
    var day = d.getDate();
    var month = monthNames[d.getMonth()];
    var year = d.getFullYear();

    return day+' '+month+' '+year;
}

var UserManager = new Marionette.Application();

UserManager.User = Backbone.Model.extend({
    urlRoot: '/user',
    parse : function(response, options) {
        return response.data;
    },
    defaults:{
        userName: "",
        userBirthday: "",
        userEmail: "",
        siteUrl: "",
        userPhone: "",
        userSkill: "",
        userGender: "",
        userAbout: ""
    }
});

// page view
UserManager.UserView = Marionette.ItemView.extend({
    el: "#main-region",
    template: '#user-template'
});

UserManager.on("before:start", function(){
    var RegionContainer = Marionette.LayoutView.extend({
        el: "#app-container",
        regions: {
            main: "#main-region"
        }
    });
    UserManager.regions = new RegionContainer();
});

// modal view
UserManager.UserView2 = Marionette.ItemView.extend({
    el: "#edit-form-view",
    template: '#edit-form',
    events: {
        "click button.js-submit": "submitClicked",
        "change input#userBirthday": "changeUserBirthdayFormatted"
    },
    changeUserBirthdayFormatted: function(){
        $('#userBirthdayFormatted').val(getFormattedDate($('#userBirthday').val()));
    },
    submitClicked: function(e){
        e.preventDefault();
        var data = Backbone.Syphon.serialize(this);
        this.model.save(data);
    }
});

UserManager.on("before:start", function(){
    var RegionContainer2 = Marionette.LayoutView.extend({
        el: "#myModal",
        regions: {
            main: "#edit-form-view"
        }
    });
    UserManager.regions = new RegionContainer2();
});

// model for page and modal views
UserManager.on("start", function(){
    var firstUser = new UserManager.User();

    firstUser.fetch({
        success: function(response, options) {
            var vasya = new UserManager.User(JSON.parse(options));
            vasya.attributes.userBirthdayFormatted = getFormattedDate(vasya.attributes.userBirthday);

            var vasyaView = new UserManager.UserView({
                model: vasya,
                modelEvents: {
                    'change': 'render'
                }
            });

            vasyaView.render();
            vasya.urlRoot = '/update';
            var vasyaView2 = new UserManager.UserView2({
                model: vasya,
                modelEvents: {
                    'change': 'render'
                }
            });
            vasyaView2.render();
        }
    });
});
UserManager.start();