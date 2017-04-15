/**
 * Flower Pot Resource object
 * handles sending/receiving data from backend
 */
var FlowerPotResource = function() {
    this.getAll = function() {
        return $.ajax({
            method: "GET",
            url: baseUrl + "flower-pots/get-all",
            dataType: "json"
        });
    };

    this.get = function(id) {
        return $.ajax({
            method: "GET",
            url: baseUrl + "flower-pots/get/" + id,
            dataType: "json"
        });
    };

    this.create = function(item) {
        return $.ajax({
            method: "POST",
            url: baseUrl + "flower-pots/create",
            data: item,
            dataType: "json"
        });
    };

    this.update = function(item) {
        return $.ajax({
            method: "POST",
            url: baseUrl + "flower-pots/update",
            data: item,
            dataType: "json"
        });
    };

    this.delete = function(id) {
        return $.ajax({
            method: "DELETE",
            url: baseUrl + "flower-pots/delete/" + id,
            dataType: "json"
        });
    };
};

/**
 * Settings Resource object
 * handles sending/receiving data from backend
 */
var SettingsResource = function() {
    this.getAll = function() {
        return $.ajax({
            method: "GET",
            url: baseUrl + "settings/get-all",
            dataType: "json"
        });
    };

    this.update = function(item) {
        return $.ajax({
            method: "POST",
            url: baseUrl + "settings/update",
            data: item,
            dataType: "json"
        });
    };
};

/**
 * DOM Events
 */
$(document).ready(function() {

    var flowerPotResource = new FlowerPotResource(),
        settingsResource = new SettingsResource(),

        // points to datatable instance
        flowerPotDataTable,

        // current edited datatable row
        flowerPotDataTableCurrentSelectedRow;

    /* Initialize Flower Pot dataTable */
    flowerPotResource.getAll().done(function(response){
        // convert response data to datatable-readable structure
        var dataSet = [];

        for (var i = 0; i < response.items.length; i++) {
            var dataSetItem = [
                response.items[i].id,
                response.items[i].name,
                response.items[i].water_morning,
                response.items[i].water_noon,
                response.items[i].water_afternoon,
                response.items[i].created_at,
                response.items[i].updated_at,
                response.items[i].id,
                response.items[i].id
            ];

            dataSet.push(dataSetItem);
        }

        flowerPotDataTable = $('#flower-pots-table').DataTable({
            data: dataSet,
            columns: [
                { title: "Id" },
                { title: "Name" },
                { title: "Water (Morning)", width: "75px" },
                { title: "Water (Noon)", width: "75px" },
                { title: "Water (Afternoon)", width: "75px" },
                { title: "Created At" },
                { title: "Updated At" },
                { title: "Edit" },
                { title: "Delete" }
            ],
            columnDefs: [
                {
                    "targets": 0,
                    "visible": false,
                    "searchable": false
                },
                {
                    "targets": 2,
                    "sortable": false,
                    "data": null,
                    "render": function ( data, type, full, meta ) {
                        if (data[2] == 1) {
                            return "<span class='text-success glyphicon glyphicon-ok' aria-hidden='true'></span>";
                        } else {
                            return "<span class='text-muted glyphicon glyphicon-remove' aria-hidden='true'></span>";
                        }
                    }
                },
                {
                    "targets": 3,
                    "sortable": false,
                    "data": null,
                    "render": function ( data, type, full, meta ) {
                        if (data[3] == 1) {
                            return "<span class='text-success glyphicon glyphicon-ok' aria-hidden='true'></span>";
                        } else {
                            return "<span class='text-muted glyphicon glyphicon-remove' aria-hidden='true'></span>";
                        }
                    }
                },
                {
                    "targets": 4,
                    "sortable": false,
                    "data": null,
                    "render": function ( data, type, full, meta ) {
                        if (data[4] == 1) {
                            return "<span class='text-success glyphicon glyphicon-ok' aria-hidden='true'></span>";
                        } else {
                            return "<span class='text-muted glyphicon glyphicon-remove' aria-hidden='true'></span>";
                        }
                    }
                },
                {
                    "targets": 5,
                    "sortable": false,
                    "data": null,
                    "render": function ( data, type, full, meta ) {
                        return '<abbr class="timeago" title="' + data[5] + '"></abbr>';
                    }
                },
                {
                    "targets": 6,
                    "sortable": false,
                    "data": null,
                    "render": function ( data, type, full, meta ) {
                        return '<abbr class="timeago" title="' + data[6] + '"></abbr>';
                    }
                },
                {
                    "targets": 7,
                    "sortable": false,
                    "data": null,
                    "render": function ( data, type, full, meta ) {
                        return '<button class="btn btn-primary btn-xs update-modal-trigger" data-title="Edit" data-toggle="modal" data-target="#add-edit"><span class="glyphicon glyphicon-pencil"></span></button>';
                    }
                },
                {
                    "targets": 8,
                    "sortable": false,
                    "data": null,
                    "render": function ( data, type, full, meta ) {
                        return '<button class="btn btn-danger btn-xs delete-modal-trigger" data-title="Delete" data-toggle="modal" data-target="#delete"><span class="glyphicon glyphicon-trash"></span></button>';
                    }
                }
            ],
            "scrollX": true,
        });
    });

    /* Configure notification plugin */
    toastr.options = {
        "closeButton": false,
        "debug": false,
        "newestOnTop": false,
        "progressBar": false,
        "positionClass": "toast-top-center",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "3000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    };

    /* Handles submission (sending to resource) of create/update data */
    var saveFlowerPot = function(action) {
        var modal = $("div#add-edit"),
            nameField = $("input#form-name"),
            valid = true;

        // validate form data
        if (nameField.val().trim().length == 0) {
            valid = false;
            nameField.parent().addClass("has-error");
        }

        // invoke resource
        if (valid) {
            var item = $("form#flower-pot-details").serialize();

            $(this).attr("disabled", "disabled");

            if (action == "create") {
                flowerPotResource.create(item).done(function(resp) {

                    // get item details and insert row to datatable
                    flowerPotResource.get(resp.insertId).done(function(response){
                        flowerPotDataTable.row.add([
                            response.item.id,
                            response.item.name,
                            response.item.water_morning,
                            response.item.water_noon,
                            response.item.water_afternoon,
                            response.item.created_at,
                            response.item.updated_at
                        ]).draw(false);
                    });

                    $(this).removeAttr("disabled");

                    // hide modal
                    modal.modal("hide");

                    // show notification
                    toastr.success(resp.message);
                });
            } else if (action == "update") {
                flowerPotResource.update(item).done(function(resp) {

                    // get item details and update datatable row
                    flowerPotResource.get($("input#form-id").val()).done(function(response){
                        flowerPotDataTableCurrentSelectedRow.data([
                            response.item.id,
                            response.item.name,
                            response.item.water_morning,
                            response.item.water_noon,
                            response.item.water_afternoon,
                            response.item.created_at,
                            response.item.updated_at
                        ]).draw(false);
                    });

                    $(this).removeAttr("disabled");

                    // hide modal
                    modal.modal("hide");

                    // show notification
                    toastr.success(resp.message);
                });
            }
        }
    }

    /* Create flower pot event handlers */
    $("button#create-modal-trigger").on("click", function(){
        var modal = $("div#add-edit"),
            nameField = $("input#form-name"),
            waterMorningField = $("input#form-water-morning"),
            waterNoonField = $("input#form-water-noon"),
            waterAfternoonField = $("input#form-water-afternoon");

        // clear fields and remove error states
        nameField.parent().removeClass("has-error")
            .end()
            .val('');

        waterMorningField.bootstrapSwitch('state', 0);
        waterNoonField.bootstrapSwitch('state', 0);
        waterAfternoonField.bootstrapSwitch('state', 0);

        // show/hide corresponding action buttons
        modal
            .find("button.update").hide()
            .end()
            .find("button.create").show();
    });

    $("div#add-edit").find("button.create").on("click", function(){
        saveFlowerPot('create');
    });

    /* Edit/Update flower pot event handlers */
    $("table#flower-pots-table").on("click", "button.update-modal-trigger", function(){
        var row = $(this).parent().parent(),
            modal = $("div#add-edit"),
            idField = $("input#form-id"),
            nameField = $("input#form-name"),
            waterMorningField = $("input#form-water-morning"),
            waterNoonField = $("input#form-water-noon"),
            waterAfternoonField = $("input#form-water-afternoon"),
            itemArr;

        // set current selected row and extract its data
        flowerPotDataTableCurrentSelectedRow = flowerPotDataTable.row(row);
        itemArr = flowerPotDataTableCurrentSelectedRow.data();

        // populate fields and remove error states
        idField.val(itemArr[0]);

        nameField.parent().removeClass("has-error")
            .end()
            .val(itemArr[1]);

        waterMorningField.bootstrapSwitch('state', (itemArr[2] == '1'));
        waterNoonField.bootstrapSwitch('state', (itemArr[3] == '1'));
        waterAfternoonField.bootstrapSwitch('state', (itemArr[4] == '1'));

        // show/hide corresponding action buttons
        modal
            .find("button.create").hide()
            .end()
            .find("button.update").show();
    });

    $("div#add-edit").find('button.update').on('click', function(){
        saveFlowerPot('update');
    });

    /* Delete flower pot event handlers */
    $("table#flower-pots-table").on("click", "button.delete-modal-trigger", function(){
        var row = $(this).parent().parent();

        // set current selected row
        flowerPotDataTableCurrentSelectedRow = flowerPotDataTable.row(row);
    });

    $("div#delete").find("button.delete").on("click", function(){
        var modal = $("div#delete"),

            // extract current selected row data
            itemArr = flowerPotDataTableCurrentSelectedRow.data();

        // invoke resource
        flowerPotResource.delete(itemArr[0]).done(function(response) {
            // remove datatable row
            flowerPotDataTableCurrentSelectedRow.remove().draw(false);

            // hide modal
            modal.modal("hide");

            // show notification
            toastr.success(response.message);
        });
    });

    /* Datatable draw event handler */
    $("#flower-pots-table").on("draw.dt", function() {
        // convert timeago elements
        $("abbr.timeago").timeago();
    });

    /* Convert checkboxes to switches */
    $("input[type='checkbox']").bootstrapSwitch();

    /* Initialize datetimepickers */
    $("div.water-timepicker").datetimepicker({
        format: 'LT'
    });

    /* Settings */
    $('div#settings').on('show.bs.modal', function (e) {
        settingsResource.getAll().done(function(response){
            // populate form fields
            $("input#form-settings-email").val(response.user_email);
            $("input#form-settings-morning-water-time").val(response.morning_water_time);
            $("input#form-settings-noon-water-time").val(response.noon_water_time);
            $("input#form-settings-afternoon-water-time").val(response.afternoon_water_time);
            $("select#form-settings-alert-advance-minutes").find("option[value='" + response.alert_advance_minutes + "']").attr("selected", "selected");
        });
    });

    $("div#settings").find("button.update").on("click", function() {
        var modal = $("div#settings"),
            emailField = $("input#form-settings-email"),
            mwtField = $("input#form-settings-morning-water-time"),
            nwtField = $("input#form-settings-noon-water-time"),
            awtField = $("input#form-settings-afternoon-water-time"),
            valid = true,
            self = $(this);

        // validate form data
        if (emailField.val().trim().length == 0) {
            valid = false;
            emailField.parent().addClass("has-error");
        }

        // invoke resource
        if (valid) {
            var items = $("form#site-settings").serialize(),
                update = settingsResource.update(items);

            self.attr("disabled", "disabled");

            update.done(function(resp) {
                // show notification
                toastr.success(resp.message);
            });

            update.fail(function(xhr){
                var response = JSON.parse(xhr.responseText);

                // show notification
                toastr.error(response.message);
            });

            update.always(function(){
                self.removeAttr("disabled");
            })
        }
    });
});