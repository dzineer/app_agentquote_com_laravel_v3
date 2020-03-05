import React from 'react';
import utils from './percentUtils';

const tests = {

    percentUtils: {
        details: 'getWidthAsPercentOfTotalWidth should return 250 with total width of 500 an percent of 50',
        callback: () => {

            const expecting = (() => {
                const $ = {
                    vars: {
                        compare: null,
                        _with: null,
                    },
                    fn: (() => {
                        return {
                            init: (vars) => {
                                $.vars = Object.assign({}, $.vars, vars);
                                return $.fn;
                            },
                            setup: (cb) => {
                                cb($.vars);
                                return $.fn;
                            },
                            logs: (show=true) => {
                                if (show) console.log('[log]', $.vars.log);
                                return $.fn;
                            },
                            run: () => {
                                expect( $.vars.compare ).toEqual( $.vars._with );
                                return $.fn;
                            }
                        }
                    })()
                };

                return $.fn;
            })();

            expecting.init({

                wrapper: null,
                width: 0,
                props: 0,
                shouldBe: '',

            }).setup(
                ($) => {

                    $.width = 250;

                    $.log = {
                        props: $.props,
                        shouldBe: $.shouldBe,
                        width: $.width
                    };

                    // guess value
                    $.compare = $.width;

                    // correct value
                    $._with = utils.getWidthAsPercentage(50, 500)

                }
            ).logs(false).run();
        }
    }
};

describe('PercentUtils', () => {
    test(tests.percentUtils.details,tests.percentUtils.callback);
});

