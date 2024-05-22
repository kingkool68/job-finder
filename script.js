function domReady(callback) {
    if (typeof document === 'undefined') {
        return;
    }

    if ( document.readyState === 'complete' || document.readyState === 'interactive') {
        return void callback();
    }

    // DOMContentLoaded has not fired yet, delay callback until then.
    document.addEventListener('DOMContentLoaded', callback);
}

domReady(function() {
    var theInput        = document.getElementById('job-keyword');
    var theSelect       = document.getElementById('timeframe');
    var theSubmitButton = document.getElementById('the-submit-button');

    theInput.addEventListener( 'change', function() {
        theSubmitButton.click();
    } )
    theSelect.addEventListener( 'change', function() {
        theSubmitButton.click();
    } );
});
