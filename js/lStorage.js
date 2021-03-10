$(function(){
    $('input[type=radio]').each(function(){
        var state = JSON.parse( localStorage.getItem('radio_'  + $(this).attr('id')) );
        
        if (state) this.checked = state.checked;
    });
});

$(window).bind('unload', function(){
    $('input[type=radio]').each(function(){
        localStorage.setItem('radio_' + $(this).attr('id'), JSON.stringify({checked: this.checked})
        );
    });
});