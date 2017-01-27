/* ==========================================================
 * bc-bootstrap-collection.js
 * http://bootstrap.braincrafted.com
 * ==========================================================
 * Copyright 2013 Florian Eckerstorfer
 *
 * ========================================================== */


!function ($) {

    "use strict"; // jshint ;_;

    /* COLLECTION CLASS DEFINITION
     * ====================== */

    var addField = '[data-addfield="collection"]',
        addSimpleField = '[data-addsimplefield="collection"]',
        removeField = '[data-removefield="collection"]',
        duplicateField = '[data-duplicatefield="collection"]',
        CollectionAdd = function (el) {
            $(el).on('click', addField, this.addField);
        },
        CollectionAddSimple = function (el) {
            $(el).on('click', addSimpleField, this.addSimpleField);
        },
        CollectionRemove = function (el) {
            $(el).on('click', removeField, this.removeField);
        },
        CollectionDuplicate = function (el) {
            $(el).on('click', duplicateField, this.duplicateField);
        }
        ;

    CollectionAdd.prototype.addField = function (e) {
        var $this = $(this),
            selector = $this.attr('data-collection'),
            prototypeName = $this.attr('data-prototype-name') || '__name__'
            ;

        e && e.preventDefault();

        var collection = $('#'+selector),
            list = collection.find('> .entry_row'),
            count = list.length || 0
            ;
        var newWidget = $this.attr('data-prototype');
        // Check if an element with this ID already exists.
        // If it does, increase the count by one and try again
        var newName = newWidget.match(/id="(.*?)"/);
        var re = new RegExp(prototypeName, "g");
        while ($('#' + newName[1].replace(re, count)).length > 0) {
            count++;
        }
        newWidget = newWidget.replace(re, count);
        newWidget = newWidget.replace(/__id__/g, newName[1].replace(re, count));
        count == 0 ? collection.prepend(newWidget) : $(list).last().after(newWidget);
        $this.trigger('collection-field-added');

        $(".datepicker").datepicker({
            format: 'dd/mm/yyyy',
            language: 'fr',
            todayHighlight: true,
            changeMonth: true,
            changeYear: true
        });
    };

    CollectionAddSimple.prototype.addSimpleField = function (e) {
        var $this = $(this),
            selector = $this.attr('data-collection'),
            entryClass = $this.attr('data-entry-class'),
            prototypeName = $this.attr('data-prototype-name') || '__name__'
            ;

        e && e.preventDefault();

        var collection = $('#'+selector),
            list = collection.find('> .' + entryClass),
            count = list.length || 0
            ;
        var newWidget = $this.attr('data-prototype');
        // Check if an element with this ID already exists.
        // If it does, increase the count by one and try again
        var newName = newWidget.match(/id="(.*?)"/);
        var re = new RegExp(prototypeName, "g");
        while ($('#' + newName[1].replace(re, count)).length > 0) {
            count++;
        }
        newWidget = newWidget.replace(re, count);
        newWidget = newWidget.replace(/__id__/g, newName[1].replace(re, count));
        count == 0 ? collection.prepend(newWidget) : $(list).last().after(newWidget);
        $this.trigger('collection-field-added');

        $(".datepicker").datepicker({
            format: 'dd/mm/yyyy',
            language: 'fr',
            todayHighlight: true,
            changeMonth: true,
            changeYear: true
        });
    };

    CollectionRemove.prototype.removeField = function (e) {
        var $this = $(this),
            selector = $this.attr('data-field'),
            parent = $this.closest('.entry_row').parent()
            ;

        e && e.preventDefault();

        $this.trigger('collection-field-removed');
        $this.trigger('collection-field-removed-before');
        var listElement = $this.closest('.entry_row').remove();
        parent.trigger('collection-field-removed-after');
    };

    CollectionDuplicate.prototype.duplicateField = function (e) {

        var $this = $(this),
            selector = $this.attr('data-collection'),
            entry = $this.closest('.entry_row'),
            entryId = $this.attr('data-entry-id'),
            entryName = $this.attr('data-entry-name'),
            objValues = {}
            ;

        e && e.preventDefault();
        var collection = $('#'+selector),
            list = collection.find('> .entry_row'),
            count = list.length || 0
            ;

        $(entry).find('[name]').map(function(el) {
            objValues[this.name] = $(this).val();
        });

        var newWidget = entry.prop('outerHTML');

        // Check if an element with this ID already exists.
        // If it does, increase the count by one and try again
        var re = new RegExp(/\d$/, "g");
        while ($('#' + entryId.replace(re, count)).length > 0) {
            count++;
        }
        var escapedId = entryId.replace(/[-\/\\^$*+?.()|[\]{}]/g, '\\$&');
        var escapedName = entryName.replace(/[-\/\\^$*+?.()|[\]{}]/g, '\\$&');

        var newId = entryId.replace(/\d$/, count);
        var newName = entryName.replace(/\[\d\]$/, "\[" + count + "\]");

        var idreplace = new RegExp("\(&quot;|\"\)" + escapedId + "(.*?)\(&quot;|\"\)","g");
        var namereplace = new RegExp("\(&quot;|\"\)" + escapedName + "(.*?)\(&quot;|\"\)","g");
        newWidget = newWidget.replace(idreplace, "$1" + newId + "$2$3");
        newWidget = newWidget.replace(namereplace, "$1" + newName + "$2$3");
        var $newWidget = $(newWidget);
        $(entry).after($newWidget);
        $.map(objValues, function(value, name){
            $('[name="' + name.replace(new RegExp(escapedName), newName) + '"]').val(value);
        });
        $this.trigger('collection-field-added');
        $this.trigger('collection-field-duplicated');

        $(".datepicker").datepicker({
            format: 'dd/mm/yyyy',
            language: 'fr',
            todayHighlight: true,
            changeMonth: true,
            changeYear: true
        });

        $(".select2").select2();
    };

    /* COLLECTION PLUGIN DEFINITION
     * ======================= */

    var oldAdd = $.fn.addField;
    var oldAddSimple = $.fn.addSimpleField;
    var oldRemove = $.fn.removeField;
    var oldDuplicate = $.fn.duplicateField;

    $.fn.addField = function (option) {
        return this.each(function () {
            var $this = $(this),
                data = $this.data('addfield')
                ;
            if (!data) {
                $this.data('addfield', (data = new CollectionAdd(this)));
            }
            if (typeof option == 'string') {
                data[option].call($this);
            }
        });
    };

    $.fn.addSimpleField = function (option) {
        return this.each(function () {
            var $this = $(this),
                data = $this.data('addSimplefield')
                ;
            if (!data) {
                $this.data('addsimplefield', (data = new CollectionAddSimple(this)));
            }
            if (typeof option == 'string') {
                data[option].call($this);
            }
        });
    };

    $.fn.removeField = function (option) {
        return this.each(function() {
            var $this = $(this),
                data = $this.data('removefield')
                ;
            if (!data) {
                $this.data('removefield', (data = new CollectionRemove(this)));
            }
            if (typeof option == 'string') {
                data[option].call($this);
            }
        });
    };

    $.fn.duplicateField = function (option) {
        return this.each(function() {
            var $this = $(this),
                data = $this.data('duplicatefield')
                ;
            if (!data) {
                $this.data('duplicatefield', (data = new CollectionDuplicate(this)));
            }
            if (typeof option == 'string') {
                data[option].call($this);
            }
        });
    };

    $.fn.addField.Constructor = CollectionAdd;
    $.fn.addSimpleField.Constructor = CollectionAddSimple;
    $.fn.removeField.Constructor = CollectionRemove;
    $.fn.duplicateField.Constructor = CollectionDuplicate;

    /* COLLECTION NO CONFLICT
     * ================= */

    $.fn.addField.noConflict = function () {
        $.fn.addField = oldAdd;
        return this;
    };
    $.fn.addSimpleField.noConflict = function () {
        $.fn.addSimpleField = oldAddSimple;
        return this;
    };
    $.fn.removeField.noConflict = function () {
        $.fn.removeField = oldRemove;
        return this;
    };
    $.fn.duplicateField.noConflict = function () {
        $.fn.duplicateField = oldDuplicate;
        return this;
    };

    /* COLLECTION DATA-API
     * ============== */

    $(document).on('click.addfield.data-api', addField, CollectionAdd.prototype.addField);
    $(document).on('click.addsimplefield.data-api', addSimpleField, CollectionAddSimple.prototype.addSimpleField);
    $(document).on('click.removefield.data-api', removeField, CollectionRemove.prototype.removeField);
    $(document).on('click.duplicatefield.data-api', duplicateField, CollectionDuplicate.prototype.duplicateField);

}(window.jQuery);