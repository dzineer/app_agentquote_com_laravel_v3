import '../../SetupTests';
import React from 'react';
import { shallow } from 'enzyme';
import ProgressBar from './ProgressBar';

const tests = {

    percentProgressBar: {
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

                        $.wrapper = shallow(
                            <ProgressBar percent={50} width={500} />
                        );

                        $.props = $.wrapper.instance().getProps();
                        $.width = $.wrapper.instance().getWidthAsPercentage( $.props.percent, $.props.width );

                        $.log = {
                            props: $.props,
                            shouldBe: $.shouldBe,
                            width: $.width
                        };

                        $.compare = $.width;
                        $._with = 250;

                    }
                ).logs(false).run();
        }
    }
};

describe('ProgressBar', () => {
    test(tests.percentProgressBar.details,tests.percentProgressBar.callback);
});

