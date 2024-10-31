(function ($) {
        seon.start({session_id: SEON_VARS['session_id'], social_detection: false, audio_fingerprint: false, use_flash: true, onSuccess: function () {}, onError: function () {
                console.log("Something went wrong. Seon API session data was not saved sucessfully!");
            }});
})(jQuery);