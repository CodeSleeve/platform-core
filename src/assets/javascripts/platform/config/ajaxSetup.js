/**
 * this will send the csrf token headers on every ajax request
 * made via jquery...
 */
$(function()
{
    $.ajaxSetup({
        headers: {
            'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
        }
    });
});