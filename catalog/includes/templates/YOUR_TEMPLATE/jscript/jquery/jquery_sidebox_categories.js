$(document).ready(function () {
    $('#categoriesContent > ul > li ul.sub-ul').each(function (index, e) {
        var count = $(e).find('li').length;
        var content = '<span class=\"cnt\"></span>';
        $(e).closest('li').children('a').append(content);
    });
    $('#categoriesContent > ul > li ul > li ul.sub-sub-ul').each(function (index, e) {
        var count = $(e).find('li').length;
        var content = '<span class=\"sub-cnt\"></span>';
        $(e).closest('li').children('a').append(content);
    });
    $('#categoriesContent ul ul li:odd').addClass('odd');
    $('#categoriesContent ul ul li:even').addClass('even');
    $('#categoriesContent > ul > li > a > .cnt').click(function () {
        $('#categoriesContent li').removeClass('active');
        $(this).closest('li').addClass('active');
        var checkElement = $(this).next();
        if ((checkElement.is('ul')) && (checkElement.is(':visible'))) {
            $(this).closest('li').removeClass('active');
            checkElement.slideUp('normal');
        }
        if ((checkElement.is('ul')) && (!checkElement.is(':visible'))) {
            $('#categoriesContent ul ul:visible').slideUp('normal');
            checkElement.slideDown('normal');
        }
        if ($(this).closest('li').find('ul').children().length == 0) {
            return true;
        } else {
            return false;
        }
    });
    $('#categoriesContent > ul > li > ul > li > a .sub-cnt').click(function () {
        $('#categoriesContent li > ul > li ').removeClass('active');
        $(this).closest('li').addClass('active');
        var checkElement = $(this).next();
        if ((checkElement.is('ul')) && (checkElement.is(':visible'))) {
            $(this).closest('li').removeClass('active');
            checkElement.slideUp('normal');
        }
        if ((checkElement.is('ul')) && (!checkElement.is(':visible'))) {
            $('#categoriesContent ul ul:visible').slideUp('normal');
            checkElement.slideDown('normal');
        }
        if ($(this).closest('li').find('ul').children().length == 0) {
            return true;
        } else {
            return false;
        }
    });

});