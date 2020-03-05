let GoogleAnalytics = {

};

GoogleAnalytics.validate = function( code ) {
    /**
     * Regular Expression snippets to validate Google Analytics tracking code
     * see http://code.google.com/apis/analytics/docs/concepts/gaConceptsAccounts.html#webProperty
     *
     * @author  Faisalman <movedpixel@gmail.com>
     * @license http://www.opensource.org/licenses/mit-license.php
     * @link    http://gist.github.com/faisalman
     * @param   str     string to be validated
     * @return  Boolean
     */

    const re = new RegExp(/^ua-\d{4,9}-\d{1,4}$/i);
    return code.match(re);
};

export default GoogleAnalytics;
