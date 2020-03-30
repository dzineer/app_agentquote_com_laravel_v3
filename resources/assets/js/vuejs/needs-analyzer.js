$(function() {

    var NA = (function($) {

        var
            // Define a local copy of NA
            NA = function() {

                // The NA object is actually just the init constructor 'enhanced'
                // Need init if NA is called (just allow error to be thrown if not included)
                return new NA.fn.init();
            };

        window.NA = NA;

        NA.fn = NA.prototype = {
            constructor: NA
        },

            NA.events = [],
            NA.numberChilden = 0,
            NA.section = '',
            NA.childrenContainer = '',
            NA.ageSelect = '',
            NA.collegeType = '',
            NA.container = '',
            NA.numberChildenInline = 0,
            NA.childContainer = '',
            NA.childContents = '',
            NA.childrensTotalContainer = '',
            NA.collegeTotals = 0.00,
            NA.collegeChildren = [],
            NA.collegeChildrenInline = []
        NA.readOnlyFields = [],
            NA.childrensTotalDisplay,

            NA.me = this;

        NA.extend = function(config) {
            var tmp = Object.create(this);
            for (var key in config) {
                if (config.hasOwnProperty(key)) {
                    tmp[key] = config[key];
                }
            }
            return tmp;
        };

        NA.NAUtils = (function() {

            NAUtils = function() {

            };

            window.NAUtils = NAUtils;

            NAUtils.fn = NAUtils.prototype = {
                constructor: NAUtils
            };

            NAUtils.fn.cleanParseFloat = function(n) {
                var tmp = n + "";

                tmp = tmp.replace(/,/g, "");
                tmp = tmp.replace(/\$/g, "");

                tmp = parseFloat(tmp);

                if (isNaN(tmp)) {
                    tmp = parseFloat(tmp);
                }

                if (isNaN(tmp)) {
                    tmp = 0;
                }
                return tmp;
            };

            NAUtils.fn.safeParseFloat = function(n) {
                var n = parseFloat(n);
                if (isNaN(n)) {
                    n = parseFloat(n);
                }
                if (isNaN(n)) {
                    n = 0;
                }
                return n;
            };

            NAUtils.fn.safeParseInt = function(n) {
                var n = parseInt(n);
                if (isNaN(n)) {
                    n = parseInt(n);
                }
                if (isNaN(n)) {
                    n = 0;
                }
                return n;
            };

        }());

        NA.data = {
            body: { state:'needs-page' },
            life: {
                yearsIncomeNeed: 10,
                inflationRate: 3,
                rateOfReturn: 6,
                netRateOfReturn: 0,
                baseNeeded: 0.00,
                add: function() {

                },
                update: function() {

                    if(NA.data.body.state == 'needs-page') {

                        this.family.totalGross = parseFloat(this.family.gross) + parseFloat(this.family.spouseGross) + parseFloat(this.family.other);

                        var format = $('[data-name="totalGross"]').data("format");

                        $('[data-name="totalGross"]').val(NA.fn.format(format, parseFloat(this.family.totalGross)));

                        this.toReplace.totalReplace = NA.fn.formatCurrency(this.family.totalGross * (parseFloat(this.toReplace.percentIncome) / 100), false);

                        $('#totalReplace').prop("readonly", false);

                        $('#totalReplace').val(this.toReplace.totalReplace);

                        $('#totalReplace').prop("readonly", true);

                        this.toReplace.totalReplace = this.toReplace.totalReplace.replace(/,/g, "");

                        this.life.netRateOfReturn = this.life.rateOfReturn - this.life.inflationRate;

                        $('#netRateOfReturn').prop("readonly", false);

                        $('#netRateOfReturn').val(this.life.netRateOfReturn);

                        $('#netRateOfReturn').prop("readonly", true);

                        var npv = NA.fn.netPVF(this.life.rateOfReturn, this.life.inflationRate, this.life.yearsIncomeNeed);

                        if (npv == 1) {
                            this.life.totalNeeded = this.life.baseNeeded * this.life.yearsIncomeNeed;
                        }
                        else {
                            this.life.totalNeeded = npv * this.life.baseNeeded;
                        }

                        this.toReplace.lifeInsuranceNeeded = this.life.totalNeeded;

                        $('#lifeInsuranceNeeded').prop("readonly", false);
                        $('#lifeInsuranceNeeded').val(NA.fn.formatCurrency(this.toReplace.lifeInsuranceNeeded, false));
                        $('#lifeInsuranceNeeded').prop("readonly", true);

                        $('#totalNeededDisplay').text(NA.fn.formatCurrency(this.life.totalNeeded, false));
                        $('#totalNeededBigDisplay').text(NA.fn.formatCurrency(this.life.totalNeeded, false));

                    }
                    else {

                        this.family.totalGross = parseFloat(this.family.gross) + parseFloat(this.family.spouseGross) + parseFloat(this.family.other);

                        var format = $('[data-name="inline-totalGross"]').data("format");

                        $('[data-name="inline-totalGross"]').val(NA.fn.format(format, parseFloat(this.family.totalGross)));

                        this.toReplace.totalReplace = NA.fn.formatCurrency(this.family.totalGross * (parseFloat(this.toReplace.percentIncome) / 100), false);

                        $('#inline-totalReplace').prop("readonly", false);

                        $('#inline-totalReplace').val(this.toReplace.totalReplace);

                        $('#inline-totalReplace').prop("readonly", true);

                        this.toReplace.totalReplace = this.toReplace.totalReplace.replace(/,/g, "");

                        this.life.netRateOfReturn = this.life.rateOfReturn - this.life.inflationRate;

                        $('#inline-netRateOfReturn').prop("readonly", false);

                        $('#inline-netRateOfReturn').val(this.life.netRateOfReturn);

                        $('#inline-netRateOfReturn').prop("readonly", true);

                        var npv = NA.fn.netPVF(this.life.rateOfReturn, this.life.inflationRate, this.life.yearsIncomeNeed);

                        if (npv == 1) {
                            this.life.totalNeeded = this.life.baseNeeded * this.life.yearsIncomeNeed;
                        }
                        else {
                            this.life.totalNeeded = npv * this.life.baseNeeded;
                        }

                        this.toReplace.lifeInsuranceNeeded = this.life.totalNeeded;

                        $('#inline-lifeInsuranceNeeded').prop("readonly", false);
                        $('#inline-lifeInsuranceNeeded').val(NA.fn.formatCurrency(this.toReplace.lifeInsuranceNeeded, false));
                        $('#inline-lifeInsuranceNeeded').prop("readonly", true);

                        $('#inline-totalNeededDisplay').text(NA.fn.formatCurrency(this.life.totalNeeded, false));
                        $('#inline-totalNeededBigDisplay').text(NA.fn.formatCurrency(this.life.totalNeeded, false));

                    }
                },
                getTotals: function() {

                }
            },
            family: {
                gross: 0.00,
                spouseGross: 0.00,
                other: 0.00,
                toReplaceIncome: 0.00,
                totalGross: 0.00,
                add: function() {
                    var format;
                    this.totalGross = parseFloat(this.gross) + parseFloat(this.spouseGross) + parseFloat(this.other);

                    if(NA.data.body.state == 'needs-page') {
                        format = $('[data-name="totalGross"]').data("format");
                        $('[data-name="totalGross"]').val(NA.fn.format(format, parseFloat(this.totalGross)));
                    }
                    else {
                        format = $('[data-name="inline-totalGross"]').data("format");
                        $('[data-name="inline-totalGross"]').val(NA.fn.format(format, parseFloat(this.totalGross)));
                    }

                },
                getTotals: function() {
                    return this.totalGross;
                },
                update: function() {

                    if(NA.data.body.state == 'needs-page') {

                        this.family.totalGross = parseFloat(this.family.gross) + parseFloat(this.family.spouseGross) + parseFloat(this.family.other);

                        var format = $('[data-name="totalGross"]').data("format");

                        $('[data-name="totalGross"]').val(NA.fn.format(format, parseFloat(this.family.totalGross)));

                        this.life.baseNeeded = this.family.totalGross * (parseFloat(this.toReplace.percentIncome) / 100);
                        this.family.toReplaceIncome = NA.fn.formatCurrency(this.life.baseNeeded, false);

                        $('#totalReplace').prop("readonly", false);

                        $('#totalReplace').val(this.family.toReplaceIncome);

                        $('#totalReplace').prop("readonly", true);

                        var npv = NA.fn.netPVF(this.life.rateOfReturn, this.life.inflationRate, this.life.yearsIncomeNeed);

                        if (npv == 1) {
                            this.life.totalNeeded = this.life.baseNeeded * this.life.yearsIncomeNeed;
                        }
                        else {
                            this.life.totalNeeded = npv * this.life.baseNeeded;
                        }

                        this.toReplace.lifeInsuranceNeeded = this.life.totalNeeded;

                        this.total.totalPart1 = parseFloat(this.life.totalNeeded) - parseFloat(this.familyAssets.totalAvailAsset);
                        this.total.totalPart2 = parseFloat(this.debt.totalDebt) + parseFloat(this.college.total) + parseFloat(this.other.totalExpenses);

                        $('#totalPart1').prop("readonly", false);
                        $('#totalPart1').val(NA.fn.formatCurrency(this.total.totalPart1, false));
                        $('#totalPart1').prop("readonly", true);

                        $('#totalPart2').prop("readonly", false);
                        $('#totalPart2').val(NA.fn.formatCurrency(this.total.totalPart2, false));
                        $('#totalPart2').prop("readonly", true);

                        this.life.totalNeeded = parseFloat(this.life.totalNeeded) + parseFloat(this.debt.totalDebt) + parseFloat(this.college.total) + parseFloat(this.other.totalExpenses);
                        this.life.totalNeeded = parseFloat(this.life.totalNeeded) - parseFloat(this.familyAssets.totalAvailAsset);

                        if (this.life.totalNeeded < 0.00) {
                            this.life.totalNeeded = 0.00;
                        }

                        $('#lifeInsuranceNeeded').prop("readonly", false);
                        $('#lifeInsuranceNeeded').val(NA.fn.formatCurrency(this.toReplace.lifeInsuranceNeeded, false));
                        $('#lifeInsuranceNeeded').prop("readonly", true);

                        $('#totalNeededDisplay').text(NA.fn.formatCurrency(this.life.totalNeeded, false));
                        $('#totalNeededBigDisplay').text(NA.fn.formatCurrency(this.life.totalNeeded, false));

                    }
                    else {

                        this.family.totalGross = parseFloat(this.family.gross) + parseFloat(this.family.spouseGross) + parseFloat(this.family.other);

                        var format = $('[data-name="inline-totalGross"]').data("format");

                        $('[data-name="inline-totalGross"]').val(NA.fn.format(format, parseFloat(this.family.totalGross)));

                        this.life.baseNeeded = this.family.totalGross * (parseFloat(this.toReplace.percentIncome) / 100);
                        this.family.toReplaceIncome = NA.fn.formatCurrency(this.life.baseNeeded, false);

                        $('#inline-totalReplace').prop("readonly", false);

                        $('#inline-totalReplace').val(this.family.toReplaceIncome);

                        $('#inline-totalReplace').prop("readonly", true);

                        var npv = NA.fn.netPVF(this.life.rateOfReturn, this.life.inflationRate, this.life.yearsIncomeNeed);

                        if (npv == 1) {
                            this.life.totalNeeded = this.life.baseNeeded * this.life.yearsIncomeNeed;
                        }
                        else {
                            this.life.totalNeeded = npv * this.life.baseNeeded;
                        }

                        this.toReplace.lifeInsuranceNeeded = this.life.totalNeeded;

                        this.total.totalPart1 = parseFloat(this.life.totalNeeded) - parseFloat(this.familyAssets.totalAvailAsset);
                        this.total.totalPart2 = parseFloat(this.debt.totalDebt) + parseFloat(this.college.total) + parseFloat(this.other.totalExpenses);

                        $('#inline-totalPart1').prop("readonly", false);
                        $('#inline-totalPart1').val(NA.fn.formatCurrency(this.total.totalPart1, false));
                        $('#inline-totalPart1').prop("readonly", true);

                        $('#inline-totalPart2').prop("readonly", false);
                        $('#inline-totalPart2').val(NA.fn.formatCurrency(this.total.totalPart2, false));
                        $('#inline-totalPart2').prop("readonly", true);

                        this.life.totalNeeded = parseFloat(this.life.totalNeeded) + parseFloat(this.debt.totalDebt) + parseFloat(this.college.total) + parseFloat(this.other.totalExpenses);
                        this.life.totalNeeded = parseFloat(this.life.totalNeeded) - parseFloat(this.familyAssets.totalAvailAsset);

                        if (this.life.totalNeeded < 0.00) {
                            this.life.totalNeeded = 0.00;
                        }

                        $('#inline-lifeInsuranceNeeded').prop("readonly", false);
                        $('#inline-lifeInsuranceNeeded').val(NA.fn.formatCurrency(this.toReplace.lifeInsuranceNeeded, false));
                        $('#inline-lifeInsuranceNeeded').prop("readonly", true);

                        $('#inline-totalNeededDisplay').text(NA.fn.formatCurrency(this.life.totalNeeded, false));
                        $('#inline-totalNeededBigDisplay').text(NA.fn.formatCurrency(this.life.totalNeeded, false));

                    }
                },
                pageLoad: function() {
                    // console.log('family');
                }
            },
            toReplace: {
                income: 0.00,
                percentIncome: 80,
                totalReplace: 0.00,
                availIncome: 0.00,
                netReplacement: 0.00,
                expectedReturn: 0.05,
                lifeInsuranceNeeded: 0.00,
                add: function() {
                    this.totalReplace = parseFloat(this.income);

                    if(NA.data.body.state == 'needs-page') {
                        $('[data-name="totalReplace"]').val(NA.fn.formatCurrency(this.totalReplace, false));
                    }
                    else {
                        $('[data-name="inline-totalReplace"]').val(NA.fn.formatCurrency(this.totalReplace, false));
                    }

                    this.netReplacement = parseFloat(this.availIncome);

                    if(NA.data.body.state == 'needs-page') {
                        $('[data-name="netReplacement"]').val(NA.fn.formatCurrency(this.netReplacement, false));
                    }
                    else {
                        $('[data-name="inline-netReplacement"]').val(NA.fn.formatCurrency(this.netReplacement, false));
                    }

                    this.assetsNeeded = this.netReplacement;

                    if(NA.data.body.state == 'needs-page') {
                        $('[data-name="assetsNeeded"]').val(NA.fn.formatCurrency(this.assetsNeeded, false));
                    }
                    else {
                        $('[data-name="inline-assetsNeeded"]').val(NA.fn.formatCurrency(this.assetsNeeded, false));
                    }
                },
                getTotals: function() {
                    return this.assetsNeeded;
                },
                update: function() {

                    if(NA.data.body.state == 'needs-page') {

                        this.family.totalGross = parseFloat(this.family.gross) + parseFloat(this.family.spouseGross) + parseFloat(this.family.other);

                        this.life.baseNeeded = this.family.totalGross * (parseFloat(this.toReplace.percentIncome) / 100);
                        this.toReplace.totalReplace = NA.fn.formatCurrency(this.life.baseNeeded, false);
                        this.family.toReplaceIncome = this.toReplace.totalReplace

                        $('#totalReplace').prop("readonly", false);

                        $('#totalReplace').val(this.family.toReplaceIncome);

                        $('#totalReplace').prop("readonly", true);

                        this.toReplace.totalReplace = this.toReplace.totalReplace.replace(/,/g, "");

                        var npv = NA.fn.netPVF(this.life.rateOfReturn, this.life.inflationRate, this.life.yearsIncomeNeed);

                        if (npv == 1) {
                            this.life.totalNeeded = this.life.baseNeeded * this.life.yearsIncomeNeed;
                        }
                        else {
                            this.life.totalNeeded = npv * this.life.baseNeeded;
                        }

                        this.toReplace.lifeInsuranceNeeded = this.life.totalNeeded;

                        $('#lifeInsuranceNeeded').prop("readonly", false);
                        $('#lifeInsuranceNeeded').val(NA.fn.formatCurrency(this.toReplace.lifeInsuranceNeeded, false));
                        $('#lifeInsuranceNeeded').prop("readonly", true);

                        this.total.totalPart1 = parseFloat(this.life.totalNeeded) - parseFloat(this.familyAssets.totalAvailAsset);

                        if (this.total.totalPart1 < 0) {
                            this.total.totalPart1 = 0;
                        }

                        this.total.totalPart2 = parseFloat(this.debt.totalDebt) + parseFloat(this.college.total) + parseFloat(this.other.totalExpenses);

                        if (this.total.totalPart2 < 0) {
                            this.total.totalPart2 = 0;
                        }

                        $('#totalPart1').prop("readonly", false);
                        $('#totalPart1').val(NA.fn.formatCurrency(this.total.totalPart1, false));
                        $('#totalPart1').prop("readonly", true);

                        $('#totalPart2').prop("readonly", false);
                        $('#totalPart2').val(NA.fn.formatCurrency(this.total.totalPart2, false));
                        $('#totalPart2').prop("readonly", true);

                        this.life.totalNeeded = parseFloat(this.life.totalNeeded) + parseFloat(this.debt.totalDebt) + parseFloat(this.college.total) + parseFloat(this.other.totalExpenses);
                        this.life.totalNeeded = parseFloat(this.life.totalNeeded) - parseFloat(this.familyAssets.totalAvailAsset);


                        if (this.life.totalNeeded < 0.00) {
                            this.life.totalNeeded = 0.00;
                        }

                        $('#totalNeededDisplay').text(NA.fn.formatCurrency(this.life.totalNeeded, false));
                        $('#totalNeededBigDisplay').text(NA.fn.formatCurrency(this.life.totalNeeded, false));

                    }
                    else {

                        this.family.totalGross = parseFloat(this.family.gross) + parseFloat(this.family.spouseGross) + parseFloat(this.family.other);

                        this.life.baseNeeded = this.family.totalGross * (parseFloat(this.toReplace.percentIncome) / 100);
                        this.toReplace.totalReplace = NA.fn.formatCurrency(this.life.baseNeeded, false);
                        this.family.toReplaceIncome = this.toReplace.totalReplace

                        $('#inline-totalReplace').prop("readonly", false);

                        $('#inline-totalReplace').val(this.family.toReplaceIncome);

                        $('#inline-otalReplace').prop("readonly", true);

                        this.toReplace.totalReplace = this.toReplace.totalReplace.replace(/,/g, "");

                        var npv = NA.fn.netPVF(this.life.rateOfReturn, this.life.inflationRate, this.life.yearsIncomeNeed);

                        if (npv == 1) {
                            this.life.totalNeeded = this.life.baseNeeded * this.life.yearsIncomeNeed;
                        }
                        else {
                            this.life.totalNeeded = npv * this.life.baseNeeded;
                        }

                        this.toReplace.lifeInsuranceNeeded = this.life.totalNeeded;

                        $('#inline-lifeInsuranceNeeded').prop("readonly", false);
                        $('#inline-lifeInsuranceNeeded').val(NA.fn.formatCurrency(this.toReplace.lifeInsuranceNeeded, false));
                        $('#inline-lifeInsuranceNeeded').prop("readonly", true);

                        this.total.totalPart1 = parseFloat(this.life.totalNeeded) - parseFloat(this.familyAssets.totalAvailAsset);

                        if (this.total.totalPart1 < 0) {
                            this.total.totalPart1 = 0;
                        }

                        this.total.totalPart2 = parseFloat(this.debt.totalDebt) + parseFloat(this.college.total) + parseFloat(this.other.totalExpenses);

                        if (this.total.totalPart2 < 0) {
                            this.total.totalPart2 = 0;
                        }

                        $('#inline-totalPart1').prop("readonly", false);
                        $('#inline-totalPart1').val(NA.fn.formatCurrency(this.total.totalPart1, false));
                        $('#inline-totalPart1').prop("readonly", true);

                        $('#inline-totalPart2').prop("readonly", false);
                        $('#inline-totalPart2').val(NA.fn.formatCurrency(this.total.totalPart2, false));
                        $('#inline-totalPart2').prop("readonly", true);

                        this.life.totalNeeded = parseFloat(this.life.totalNeeded) + parseFloat(this.debt.totalDebt) + parseFloat(this.college.total) + parseFloat(this.other.totalExpenses);
                        this.life.totalNeeded = parseFloat(this.life.totalNeeded) - parseFloat(this.familyAssets.totalAvailAsset);


                        if (this.life.totalNeeded < 0.00) {
                            this.life.totalNeeded = 0.00;
                        }

                        $('#inline-totalNeededDisplay').text(NA.fn.formatCurrency(this.life.totalNeeded, false));
                        $('#inline-totalNeededBigDisplay').text(NA.fn.formatCurrency(this.life.totalNeeded, false));

                    }
                },
                pageLoad: function() {
                    // console.log('toReplace');
                }
            },
            familyAssets: {
                savings: 0.00,
                investment: 0.00,
                lifeInsurance: 0.00,
                other: 0.00,
                totalAvailAsset: 0.00,
                lifeNeeded: 0.00,
                add: function() {
                },
                getTotals: function() {
                },
                update: function() {

                    if(NA.data.body.state == 'needs-page') {

                        this.familyAssets.totalAvailAsset = parseFloat(this.familyAssets.savings) + parseFloat(this.familyAssets.investment) + parseFloat(this.familyAssets.lifeInsurance) + parseFloat(this.familyAssets.other);

                        $('[data-name="totalAvailAsset"]').val(NA.fn.formatCurrency(this.familyAssets.totalAvailAsset, false));

                        this.family.totalGross = parseFloat(this.family.gross) + parseFloat(this.family.spouseGross) - parseFloat(this.family.other);

                        this.life.baseNeeded = this.family.totalGross * (parseFloat(this.toReplace.percentIncome) / 100);

                        this.toReplace.totalReplace =  this.life.baseNeeded;

                        this.toReplace.totalReplace = NA.fn.formatCurrency(this.family.totalGross * (parseFloat(this.toReplace.percentIncome) / 100), false);

                        this.toReplace.totalReplace = this.toReplace.totalReplace.replace(/,/g, "");

                        this.life.baseNeeded = this.toReplace.totalReplace;

                        var npv = NA.fn.netPVF(this.life.rateOfReturn, this.life.inflationRate, this.life.yearsIncomeNeed);

                        if (npv == 1) {
                            this.life.totalNeeded = this.life.baseNeeded * this.life.yearsIncomeNeed;
                        }
                        else {
                            this.life.totalNeeded = npv * this.life.baseNeeded;
                        }

                        this.total.totalPart1 = parseFloat(this.life.totalNeeded) - parseFloat(this.familyAssets.totalAvailAsset);

                        if (this.total.totalPart1 < 0) {
                            this.total.totalPart1 = 0;
                        }

                        this.total.totalPart2 = parseFloat(this.debt.totalDebt) + parseFloat(this.college.total) + parseFloat(this.other.totalExpenses);

                        if (this.total.totalPart2 < 0) {
                            this.total.totalPart2 = 0;
                        }

                        $('#totalPart1').prop("readonly", false);
                        $('#totalPart1').val(NA.fn.formatCurrency(this.total.totalPart1, false));
                        $('#totalPart1').prop("readonly", true);

                        $('#totalPart2').prop("readonly", false);
                        $('#totalPart2').val(NA.fn.formatCurrency(this.total.totalPart2, false));
                        $('#totalPart2').prop("readonly", true);

                        this.life.totalNeeded = parseFloat(this.life.totalNeeded) + parseFloat(this.debt.totalDebt) + parseFloat(this.college.total) + parseFloat(this.other.totalExpenses);
                        this.life.totalNeeded = parseFloat(this.life.totalNeeded) - parseFloat(this.familyAssets.totalAvailAsset);

                        if (this.life.totalNeeded < 0.00) {
                            this.life.totalNeeded = 0.00;
                        }

                        $('#totalNeededDisplay').text(NA.fn.formatCurrency(this.life.totalNeeded, false));
                        $('#totalNeededBigDisplay').text(NA.fn.formatCurrency(this.life.totalNeeded, false));

                    }
                    else {

                        this.familyAssets.totalAvailAsset = parseFloat(this.familyAssets.savings) + parseFloat(this.familyAssets.investment) + parseFloat(this.familyAssets.lifeInsurance) + parseFloat(this.familyAssets.other);

                        $('[data-name="inline-totalAvailAsset"]').val(NA.fn.formatCurrency(this.familyAssets.totalAvailAsset, false));

                        this.family.totalGross = parseFloat(this.family.gross) + parseFloat(this.family.spouseGross) - parseFloat(this.family.other);

                        this.life.baseNeeded = this.family.totalGross * (parseFloat(this.toReplace.percentIncome) / 100);

                        this.toReplace.totalReplace =  this.life.baseNeeded;

                        this.toReplace.totalReplace = NA.fn.formatCurrency(this.family.totalGross * (parseFloat(this.toReplace.percentIncome) / 100), false);

                        this.toReplace.totalReplace = this.toReplace.totalReplace.replace(/,/g, "");

                        this.life.baseNeeded = this.toReplace.totalReplace;

                        var npv = NA.fn.netPVF(this.life.rateOfReturn, this.life.inflationRate, this.life.yearsIncomeNeed);

                        if (npv == 1) {
                            this.life.totalNeeded = this.life.baseNeeded * this.life.yearsIncomeNeed;
                        }
                        else {
                            this.life.totalNeeded = npv * this.life.baseNeeded;
                        }

                        this.total.totalPart1 = parseFloat(this.life.totalNeeded) - parseFloat(this.familyAssets.totalAvailAsset);

                        if (this.total.totalPart1 < 0) {
                            this.total.totalPart1 = 0;
                        }

                        this.total.totalPart2 = parseFloat(this.debt.totalDebt) + parseFloat(this.college.total) + parseFloat(this.other.totalExpenses);

                        if (this.total.totalPart2 < 0) {
                            this.total.totalPart2 = 0;
                        }

                        $('#inline-totalPart1').prop("readonly", false);
                        $('#inline-totalPart1').val(NA.fn.formatCurrency(this.total.totalPart1, false));
                        $('#inline-totalPart1').prop("readonly", true);

                        $('#inline-totalPart2').prop("readonly", false);
                        $('#inline-totalPart2').val(NA.fn.formatCurrency(this.total.totalPart2, false));
                        $('#inline-totalPart2').prop("readonly", true);

                        this.life.totalNeeded = parseFloat(this.life.totalNeeded) + parseFloat(this.debt.totalDebt) + parseFloat(this.college.total) + parseFloat(this.other.totalExpenses);
                        this.life.totalNeeded = parseFloat(this.life.totalNeeded) - parseFloat(this.familyAssets.totalAvailAsset);

                        if (this.life.totalNeeded < 0.00) {
                            this.life.totalNeeded = 0.00;
                        }

                        $('#inline-totalNeededDisplay').text(NA.fn.formatCurrency(this.life.totalNeeded, false));
                        $('#inline-totalNeededBigDisplay').text(NA.fn.formatCurrency(this.life.totalNeeded, false));

                    }
                },
                pageLoad: function() {

                }
            },
            debt: {
                mortgage: 0.00,
                autoLoan: 0.00,
                consumerDebt: 0.00,
                otherDebt: 0.00,
                totalDebt: 0.00,
                add: function() {
                },
                getTotals: function() {
                },
                update: function() {

                    if(NA.data.body.state == 'needs-page') {

                        this.debt.totalDebt = parseFloat(this.debt.mortgage) + parseFloat(this.debt.autoLoan) + parseFloat(this.debt.consumerDebt) + parseFloat(this.debt.otherDebt);

                        $('[data-name="totalDebt"]').val(NA.fn.formatCurrency(this.debt.totalDebt, false));

                        this.family.totalGross = parseFloat(this.family.gross) + parseFloat(this.family.spouseGross) - parseFloat(this.family.other);

                        this.life.baseNeeded = this.family.totalGross * (parseFloat(this.toReplace.percentIncome) / 100);

                        this.toReplace.totalReplace =  this.life.baseNeeded;

                        this.toReplace.totalReplace = NA.fn.formatCurrency(this.toReplace.totalReplace, false);

                        this.toReplace.totalReplace = this.family.toReplaceIncome;

                        this.toReplace.totalReplace = this.toReplace.totalReplace.replace(/,/g, "");

                        this.life.baseNeeded = this.toReplace.totalReplace;

                        var npv = NA.fn.netPVF(this.life.rateOfReturn, this.life.inflationRate, this.life.yearsIncomeNeed);

                        if (npv == 1) {
                            this.life.totalNeeded = this.life.baseNeeded * this.life.yearsIncomeNeed;
                        }
                        else {
                            this.life.totalNeeded = npv * this.life.baseNeeded;
                        }

                        this.total.totalPart1 = parseFloat(this.life.totalNeeded) - parseFloat(this.familyAssets.totalAvailAsset);

                        if (this.total.totalPart1 < 0) {
                            this.total.totalPart1 = 0;
                        }

                        this.total.totalPart2 = parseFloat(this.debt.totalDebt) + parseFloat(this.college.total) + parseFloat(this.other.totalExpenses);

                        if (this.total.totalPart2 < 0) {
                            this.total.totalPart2 = 0;
                        }

                        $('#totalPart1').prop("readonly", false);
                        $('#totalPart1').val(NA.fn.formatCurrency(this.total.totalPart1, false));
                        $('#totalPart1').prop("readonly", true);

                        $('#totalPart2').prop("readonly", false);
                        $('#totalPart2').val(NA.fn.formatCurrency(this.total.totalPart2, false));
                        $('#totalPart2').prop("readonly", true);

                        this.life.totalNeeded = parseFloat(this.life.totalNeeded) + parseFloat(this.debt.totalDebt) + parseFloat(this.college.total) + parseFloat(this.other.totalExpenses);
                        this.life.totalNeeded = parseFloat(this.life.totalNeeded) - parseFloat(this.familyAssets.totalAvailAsset);

                        if (this.life.totalNeeded < 0.00) {
                            this.life.totalNeeded = 0.00;
                        }

                        $('#totalNeededDisplay').text(NA.fn.formatCurrency(this.life.totalNeeded, false));
                        $('#totalNeededBigDisplay').text(NA.fn.formatCurrency(this.life.totalNeeded, false));

                    }
                    else {

                        this.debt.totalDebt = parseFloat(this.debt.mortgage) + parseFloat(this.debt.autoLoan) + parseFloat(this.debt.consumerDebt) + parseFloat(this.debt.otherDebt);

                        $('[data-name="inline-totalDebt"]').val(NA.fn.formatCurrency(this.debt.totalDebt, false));

                        this.family.totalGross = parseFloat(this.family.gross) + parseFloat(this.family.spouseGross) - parseFloat(this.family.other);

                        this.life.baseNeeded = this.family.totalGross * (parseFloat(this.toReplace.percentIncome) / 100);

                        this.toReplace.totalReplace =  this.life.baseNeeded;

                        this.toReplace.totalReplace = NA.fn.formatCurrency(this.toReplace.totalReplace, false);

                        this.toReplace.totalReplace = this.family.toReplaceIncome;

                        this.toReplace.totalReplace = this.toReplace.totalReplace.replace(/,/g, "");

                        this.life.baseNeeded = this.toReplace.totalReplace;

                        var npv = NA.fn.netPVF(this.life.rateOfReturn, this.life.inflationRate, this.life.yearsIncomeNeed);

                        if (npv == 1) {
                            this.life.totalNeeded = this.life.baseNeeded * this.life.yearsIncomeNeed;
                        }
                        else {
                            this.life.totalNeeded = npv * this.life.baseNeeded;
                        }

                        this.total.totalPart1 = parseFloat(this.life.totalNeeded) - parseFloat(this.familyAssets.totalAvailAsset);

                        if (this.total.totalPart1 < 0) {
                            this.total.totalPart1 = 0;
                        }

                        this.total.totalPart2 = parseFloat(this.debt.totalDebt) + parseFloat(this.college.total) + parseFloat(this.other.totalExpenses);

                        if (this.total.totalPart2 < 0) {
                            this.total.totalPart2 = 0;
                        }

                        $('#inline-totalPart1').prop("readonly", false);
                        $('#inline-totalPart1').val(NA.fn.formatCurrency(this.total.totalPart1, false));
                        $('#inline-totalPart1').prop("readonly", true);

                        $('#inline-totalPart2').prop("readonly", false);
                        $('#inline-totalPart2').val(NA.fn.formatCurrency(this.total.totalPart2, false));
                        $('#inline-totalPart2').prop("readonly", true);

                        this.life.totalNeeded = parseFloat(this.life.totalNeeded) + parseFloat(this.debt.totalDebt) + parseFloat(this.college.total) + parseFloat(this.other.totalExpenses);
                        this.life.totalNeeded = parseFloat(this.life.totalNeeded) - parseFloat(this.familyAssets.totalAvailAsset);

                        if (this.life.totalNeeded < 0.00) {
                            this.life.totalNeeded = 0.00;
                        }

                        $('#inline-totalNeededDisplay').text(NA.fn.formatCurrency(this.life.totalNeeded, false));
                        $('#inline-totalNeededBigDisplay').text(NA.fn.formatCurrency(this.life.totalNeeded, false));

                    }
                },
                pageLoad: function() {
                    // console.log('toReplace');
                }
            },
            college: {

                total: 0.00,
                inflationRate: 6,
                children: [],
                inLinechildren: [],

                add: function() {
                },
                getTotals: function() {
                },
                update: function() {

                    var totalCostStr;

                    if(NA.data.body.state == 'needs-page') {

                        if (NA.numberChilden == 0) {
                            this.college.total = 0.00;
                            $('#totalCollegeCosts').html(NA.fn.formatCurrency(this.college.total, true));
                        }
                        else {

                            this.college.total = 0.00;

                            for (var i = 0; i < NA.collegeChildren.length; i++) {
                                var tmpCost = NA.collegeChildren[i].data.collegeCost + "";
                                tmpCost = tmpCost.replace(/,/g, "");
                                this.college.total = parseFloat(this.college.total) + parseFloat(tmpCost);
                            }

                            totalCostStr = NA.fn.formatCurrency(this.college.total, true);

                            $('#totalCollegeCosts').html( totalCostStr );

                        }

                        this.family.totalGross = parseFloat(this.family.gross) + parseFloat(this.family.spouseGross) + parseFloat(this.family.other);

                        this.life.baseNeeded = this.family.totalGross * (parseFloat(this.toReplace.percentIncome) / 100);

                        this.toReplace.totalReplace =  this.life.baseNeeded;

                        this.toReplace.totalReplace = NA.fn.formatCurrency(this.toReplace.totalReplace, false);

                        this.toReplace.totalReplace = this.toReplace.totalReplace.replace(/,/g, "");

                        this.life.baseNeeded = this.toReplace.totalReplace;

                        var npv = NA.fn.netPVF(this.life.rateOfReturn, this.life.inflationRate, this.life.yearsIncomeNeed);

                        if (npv == 1) {
                            this.life.totalNeeded = this.life.baseNeeded * this.life.yearsIncomeNeed;
                        }
                        else {
                            this.life.totalNeeded = npv * this.life.baseNeeded;
                        }

                        this.total.totalPart1 = parseFloat(this.life.totalNeeded) - parseFloat(this.familyAssets.totalAvailAsset);

                        if (this.total.totalPart1 < 0) {
                            this.total.totalPart1 = 0;
                        }

                        this.total.totalPart2 = parseFloat(this.debt.totalDebt) + parseFloat(this.college.total) + parseFloat(this.other.totalExpenses);

                        if (this.total.totalPart2 < 0) {
                            this.total.totalPart2 = 0;
                        }

                        $('#totalPart1').prop("readonly", false);
                        $('#totalPart1').val(NA.fn.formatCurrency(this.total.totalPart1, false));
                        $('#totalPart1').prop("readonly", true);

                        $('#totalPart2').prop("readonly", false);
                        $('#totalPart2').val(NA.fn.formatCurrency(this.total.totalPart2, false));
                        $('#totalPart2').prop("readonly", true);

                        this.life.totalNeeded = parseFloat(this.life.totalNeeded) + parseFloat(this.debt.totalDebt) + parseFloat(this.college.total) + parseFloat(this.other.totalExpenses);
                        this.life.totalNeeded = parseFloat(this.life.totalNeeded) - parseFloat(this.familyAssets.totalAvailAsset);

                        if (this.life.totalNeeded < 0.00) {
                            this.life.totalNeeded = 0.00;
                        }

                        $('#totalNeededDisplay').text(NA.fn.formatCurrency(this.life.totalNeeded, false));
                        $('#totalNeededBigDisplay').text(NA.fn.formatCurrency(this.life.totalNeeded, false));

                    }
                    else {

                        if (NA.numberChildenInline == 0) {
                            this.college.total = 0.00;
                            $('#inline-totalCollegeCosts').html(NA.fn.formatCurrency(this.college.total, true));
                        }
                        else {

                            this.college.total = 0.00;

                            for (var i = 0; i < NA.collegeChildrenInline.length; i++) {
                                var tmpCost = NA.collegeChildrenInline[i].data.collegeCost + "";
                                tmpCost = tmpCost.replace(/,/g, "");
                                this.college.total = parseFloat(this.college.total) + parseFloat(tmpCost);
                            }

                            totalCostStr = NA.fn.formatCurrency(this.college.total, true);

                            $('#inline-totalCollegeCosts').html( totalCostStr );

                        }

                        this.family.totalGross = parseFloat(this.family.gross) + parseFloat(this.family.spouseGross) + parseFloat(this.family.other);

                        this.life.baseNeeded = this.family.totalGross * (parseFloat(this.toReplace.percentIncome) / 100);

                        this.toReplace.totalReplace =  this.life.baseNeeded;

                        this.toReplace.totalReplace = NA.fn.formatCurrency(this.toReplace.totalReplace, false);

                        this.toReplace.totalReplace = this.toReplace.totalReplace.replace(/,/g, "");

                        this.life.baseNeeded = this.toReplace.totalReplace;

                        var npv = NA.fn.netPVF(this.life.rateOfReturn, this.life.inflationRate, this.life.yearsIncomeNeed);

                        if (npv == 1) {
                            this.life.totalNeeded = this.life.baseNeeded * this.life.yearsIncomeNeed;
                        }
                        else {
                            this.life.totalNeeded = npv * this.life.baseNeeded;
                        }

                        this.total.totalPart1 = parseFloat(this.life.totalNeeded) - parseFloat(this.familyAssets.totalAvailAsset);

                        if (this.total.totalPart1 < 0) {
                            this.total.totalPart1 = 0;
                        }

                        this.total.totalPart2 = parseFloat(this.debt.totalDebt) + parseFloat(this.college.total) + parseFloat(this.other.totalExpenses);

                        if (this.total.totalPart2 < 0) {
                            this.total.totalPart2 = 0;
                        }

                        $('#inline-totalPart1').prop("readonly", false);
                        $('#inline-totalPart1').val(NA.fn.formatCurrency(this.total.totalPart1, false));
                        $('#inline-totalPart1').prop("readonly", true);

                        $('#inline-totalPart2').prop("readonly", false);
                        $('#inline-totalPart2').val(NA.fn.formatCurrency(this.total.totalPart2, false));
                        $('#inline-totalPart2').prop("readonly", true);

                        this.life.totalNeeded = parseFloat(this.life.totalNeeded) + parseFloat(this.debt.totalDebt) + parseFloat(this.college.total) + parseFloat(this.other.totalExpenses);
                        this.life.totalNeeded = parseFloat(this.life.totalNeeded) - parseFloat(this.familyAssets.totalAvailAsset);

                        if (this.life.totalNeeded < 0.00) {
                            this.life.totalNeeded = 0.00;
                        }

                        $('#inline-totalNeededDisplay').text(NA.fn.formatCurrency(this.life.totalNeeded, false));
                        $('#inline-totalNeededBigDisplay').text(NA.fn.formatCurrency(this.life.totalNeeded, false));

                    }
                },
                pageLoad: function() {
                    // console.log('toReplace');
                },
                calculate: function(c, r, waitTime, duration) {

                    var
                        totalCollegeCosts = 0.00,
                        tempC,
                        tempR,
                        tempWaitTime,
                        tempDuration,
                        realC,
                        totalCollegeCosts = 0,
                        collegeCostArr;

                    try {

                        tempC = parseFloat(c);
                        tempR = parseFloat(r) / 100;
                        tempWaitTime = parseInt(waitTime);
                        tempDuration = parseInt(duration);
                        realC;
                        totalCollegeCosts = 0;
                        collegeCostArr = [];

                        realC = tempC;

                        if (tempWaitTime > 0) {

/*                            for (i = 0; i < Math.min(tempWaitTime, 4); i++) {
                                realC = realC * Math.pow((1 + tempR), i);
                                totalCollegeCosts[i] = realC;
                            }*/


                            realC = realC * Math.pow((1 + tempR), (tempWaitTime-1));
                           // totalCollegeCosts[i] = realC;
                        }
                        else if(tempWaitTime == 1 || tempWaitTime == 0) {
                            realC = tempC;
                        }

                        realC = NA.fn.formatCurrency(realC, false);

                        return realC;

                    } catch (err) {
                        alert("Invalid data, unable to  calcualte your results.");
                    }

                }

            },
            other: {
                funeral: 0.00,
                bequests: 0.00,
                otherExpenses: 0.00,
                totalExpenses: 0.00,
                add: function() {
                },
                getTotals: function() {
                },
                update: function() {

                    if(NA.data.body.state == 'needs-page') {

                        this.other.totalExpenses = parseFloat(this.other.funeral) + parseFloat(this.other.bequests) + parseFloat(this.other.otherExpenses);

                        $('[data-name="totalExpenses"]').val(NA.fn.formatCurrency(this.other.totalExpenses, false));

                        this.family.totalGross = parseFloat(this.family.gross) + parseFloat(this.family.spouseGross) + parseFloat(this.family.other);

                        this.life.baseNeeded = this.family.totalGross * (parseFloat(this.toReplace.percentIncome) / 100);

                        this.toReplace.totalReplace =  this.life.baseNeeded;

                        this.toReplace.totalReplace = NA.fn.formatCurrency(this.toReplace.totalReplace, false);

                        this.toReplace.totalReplace = this.toReplace.totalReplace.replace(/,/g, "");

                        this.life.baseNeeded = this.toReplace.totalReplace;

                        var npv = NA.fn.netPVF(this.life.rateOfReturn, this.life.inflationRate, this.life.yearsIncomeNeed);

                        if (npv == 1) {
                            this.life.totalNeeded = this.life.baseNeeded * this.life.yearsIncomeNeed;
                        }
                        else {
                            this.life.totalNeeded = npv * this.life.baseNeeded;
                        }

                        this.total.totalPart1 = parseFloat(this.life.totalNeeded) - parseFloat(this.familyAssets.totalAvailAsset);

                        if (this.total.totalPart1 < 0) {
                            this.total.totalPart1 = 0;
                        }

                        this.total.totalPart2 = parseFloat(this.debt.totalDebt) + parseFloat(this.college.total) + parseFloat(this.other.totalExpenses);

                        if (this.total.totalPart2 < 0) {
                            this.total.totalPart2 = 0;
                        }

                        $('#totalPart1').prop("readonly", false);
                        $('#totalPart1').val(NA.fn.formatCurrency(this.total.totalPart1, false));
                        $('#totalPart1').prop("readonly", true);

                        $('#totalPart2').prop("readonly", false);
                        $('#totalPart2').val(NA.fn.formatCurrency(this.total.totalPart2, false));
                        $('#totalPart2').prop("readonly", true);

                        this.life.totalNeeded = parseFloat(this.life.totalNeeded) + parseFloat(this.debt.totalDebt) + parseFloat(this.college.total) + parseFloat(this.other.totalExpenses);
                        this.life.totalNeeded = parseFloat(this.life.totalNeeded) - parseFloat(this.familyAssets.totalAvailAsset);

                        if (this.life.totalNeeded < 0.00) {
                            this.life.totalNeeded = 0.00;
                        }

                        $('#totalNeededDisplay').text(NA.fn.formatCurrency(this.life.totalNeeded, false));
                        $('#totalNeededBigDisplay').text(NA.fn.formatCurrency(this.life.totalNeeded, false));

                    }
                    else {

                        this.other.totalExpenses = parseFloat(this.other.funeral) + parseFloat(this.other.bequests) + parseFloat(this.other.otherExpenses);

                        $('[data-name="inline-totalExpenses"]').val(NA.fn.formatCurrency(this.other.totalExpenses, false));

                        this.family.totalGross = parseFloat(this.family.gross) + parseFloat(this.family.spouseGross) + parseFloat(this.family.other);

                        this.life.baseNeeded = this.family.totalGross * (parseFloat(this.toReplace.percentIncome) / 100);

                        this.toReplace.totalReplace =  this.life.baseNeeded;

                        this.toReplace.totalReplace = NA.fn.formatCurrency(this.toReplace.totalReplace, false);

                        this.toReplace.totalReplace = this.toReplace.totalReplace.replace(/,/g, "");

                        this.life.baseNeeded = this.toReplace.totalReplace;

                        var npv = NA.fn.netPVF(this.life.rateOfReturn, this.life.inflationRate, this.life.yearsIncomeNeed);

                        if (npv == 1) {
                            this.life.totalNeeded = this.life.baseNeeded * this.life.yearsIncomeNeed;
                        }
                        else {
                            this.life.totalNeeded = npv * this.life.baseNeeded;
                        }

                        this.total.totalPart1 = parseFloat(this.life.totalNeeded) - parseFloat(this.familyAssets.totalAvailAsset);

                        if (this.total.totalPart1 < 0) {
                            this.total.totalPart1 = 0;
                        }

                        this.total.totalPart2 = parseFloat(this.debt.totalDebt) + parseFloat(this.college.total) + parseFloat(this.other.totalExpenses);

                        if (this.total.totalPart2 < 0) {
                            this.total.totalPart2 = 0;
                        }

                        $('#inline-totalPart1').prop("readonly", false);
                        $('#inline-totalPart1').val(NA.fn.formatCurrency(this.total.totalPart1, false));
                        $('#inline-totalPart1').prop("readonly", true);

                        $('#inline-totalPart2').prop("readonly", false);
                        $('#inline-totalPart2').val(NA.fn.formatCurrency(this.total.totalPart2, false));
                        $('#inline-totalPart2').prop("readonly", true);

                        this.life.totalNeeded = parseFloat(this.life.totalNeeded) + parseFloat(this.debt.totalDebt) + parseFloat(this.college.total) + parseFloat(this.other.totalExpenses);
                        this.life.totalNeeded = parseFloat(this.life.totalNeeded) - parseFloat(this.familyAssets.totalAvailAsset);

                        if (this.life.totalNeeded < 0.00) {
                            this.life.totalNeeded = 0.00;
                        }

                        $('#inline-totalNeededDisplay').text(NA.fn.formatCurrency(this.life.totalNeeded, false));
                        $('#inline-totalNeededBigDisplay').text(NA.fn.formatCurrency(this.life.totalNeeded, false));

                    }
                },
                pageLoad: function() {
                    // console.log('toReplace');
                }
            },
            total: {
                totalPart1: 0.00,
                totalPart2: 0.00,
                totalNeeded: 0.00,
                add: function() {
                },
                update: function() {

                },
                getTotals: function() {
                },
                pageLoad: function() {
                    // console.log('total');
                }
            }
        };

        NA.fn.college = {};
        NA.fn.college.calcualte = function() {

        };

        NA.form = {
            inputs: []
        };

        NA.fn.addEvent = function(eventName, target, fn) {

            (function(na) {
                NA.events.push({
                    eventName: eventName,
                    target: target,
                    fn: fn
                });
                $(target).on(eventName, fn);
            })(this.me);
        };

        NA.fn.addObjectEvent = function(eventName, obj, fn) {

            (function(na) {
                NA.events.push({
                    eventName: eventName,
                    target: obj,
                    fn: fn
                });
                obj.on(eventName, fn);
            })(this.me);
        };

        NA.fn.format = function(f, v) {
            switch (f) {
                case 'float':
                    return NA.fn.formatCurrency(v, false);
                    break;
                case 'text':
                    return v;

                case 'percent':
                    return parseInt(v);

                case 'number':
                    return parseInt(v);

                default:
                    return v;
            }
        };

        NA.fn.netPVF = function(r, ir, yy) {
            var rr;

            if (ir == r) {
                return 1;
            }
            else if (r <= 0) {
                return 1;
            }
            else if (r == rr) {
                return 1;
            }

            rr = (r - ir) / 100;

            return (1 - (1 / Math.pow((1 + rr), yy))) / rr;
        };

        NA.fn.formatCurrency = function(num, useDollar) {
            var symbol = '';

            if (isNaN(num))
                num = "0";

            if (useDollar)
                symbol = '$';

            sign = (num == (num = Math.abs(num)));
            num = Math.floor(num * 100 + 0.50000000001);
            cents = num % 100;
            num = Math.floor(num / 100).toString();
            if (cents < 10)
                cents = "0" + cents;
            for (var i = 0; i < Math.floor((num.length - (1 + i)) / 3); i++)
                num = num.substring(0, num.length - (4 * i + 3)) + ',' + num.substring(num.length - (4 * i + 3));

            return ( ((sign) ? '' : '-') + symbol + num + '.' + cents) ;
        };

        NA.fn.listEvents = function(eventName) {
            return NA.events.filter(function(evtObj) {
                return evtObj.eventName === eventName;
            });
        };

        NA.fn.init = function(fn, obj) {
            fn.call(NA, obj);
        };

        NA.fn.createAgeSelect = function(s, e, obj) {

            var select = $('<select />', obj);

            for (var i = s; i < e; i++) {
                var option = $('<option />', {
                    val: i,
                    text: i
                });
                select.append(option);
            }

            return select;

        };

        NA.fn.createElem = function(tag, obj) {

            var el = $('<' + tag + ' />', obj);

            return el;

        };

        NA.fn.createSelect = function(labels, values, obj) {

            var select = NA.fn.createElem('select', obj);

            for (var i = 0; i < labels.length; i++) {

                var label = labels[i];
                var value = values[i];
                var option = NA.fn.createElem('option', {
                    val: value,
                    text: label,
                    class: ''
                });

                select.append(option);
            }

            return select;

        };

        NA.fn.setFieldsReadOnly = function(fn, obj) {
            fn.call(NA, obj);
        };

        return NA;

    }(jQuery));

    NA.fn.init(function(o) {
        var inputs;
        var inlineInputs;

        NA.section = $(o.startSection);
        NA.section.addClass('show');

        NA.fn.setFieldsReadOnly(function(o) {

            // get all read-only fields
            NA.readOnlyFields = $(o.exp);

            NA.readOnlyFields.each(function(e) {
                $(this).prop('readonly', true);
            });

        }, {
            exp: '[data-readonly="true"]'
        });

        inlineInputs = $(".page-inline").find(':input');

        inputs = $(".sect").find(':input');

        inputs = $.merge(inputs, inlineInputs);

        //<-- Should return all input elements in that specific form.

        inputs.each(function() {
            NA.form.inputs.push(this);
        });

        // console.log(NA.form.inputs)

    }, {
        startSection: '.sect.start'
    });

    NA.fn.addEvent("click", ".na-btn", function(event) {

        NA.section = {
            section: $(this).data("item"),
            className: $(this).data("item"),
            menuItem: $(this),
            instance: $('.sect.' + $(this).data("item")),
            page: $(this).data("page")
        };
        NA.sections = $('.sect');
        NA.selected = $('.selected');

        NA.sections.removeClass('show');
        NA.selected.removeClass('selected');

        // console.log("item: " + NA.section.section);

        //  section.addClass("show");

        NA.section.instance.addClass('show');
        NA.section.menuItem.addClass('selected');

        NA.data[NA.section.page].pageLoad.call(NA.data);

        return false;

    });

    NA.fn.addObjectEvent("change", $(".inline-controls :input").not("select.children-select"), function(event) {

        var
            group,
            input,
            format,
            val;

        group = $(this).data('group'),

            input = $(this).data('name'),
            format = $(this).data("format"),
            val = parseFloat($(this).val());

        NA.data[group][input] = val;

        NA.data[group].add();
        NA.data[group].update.call(NA.data);
        NA.data[group].getTotals();

        val = NA.fn.format(format, val);

        $(this).val(val);

        // console.log('input: ' + input);

    });

    NA.fn.addObjectEvent("change", $(".needs-analyzer .body :input").not("select.children-select"), function(event) {

        var
            group,
            input,
            format,
            val;

        group = $(this).data('group'),

            input = $(this).data('name'),
            format = $(this).data("format"),
            val = parseFloat($(this).val());

        NA.data[group][input] = val;

        NA.data[group].add();
        NA.data[group].update.call(NA.data);
        NA.data[group].getTotals();

        val = NA.fn.format(format, val);

        $(this).val(val);

        // console.log('input: ' + input);

    });

    NA.fn.addEvent("resize", window, function(event) {

        var screenWidth = $(this).width();
        var body = $('body');

        if(screenWidth < 768) {
            if(body.hasClass('needs-page')) {
                body.removeClass('needs-page');
            }
            body.addClass('needs-inline');
            NA.data.body.state = 'needs-inline';
        }
        else {
            if(body.hasClass('needs-inline')) {
                body.removeClass('needs-inline');
            }
            body.addClass('needs-page');
            NA.data.body.state = 'needs-page';
        }

    });

    NA.fn.addEvent("load", window, function(event) {

        var body = $('body');
        var screenWidth = $('body').width();

        if(screenWidth < 768) {
            if(body.hasClass('needs-page')) {
                body.removeClass('needs-page');
            }
            body.addClass('needs-inline');
            NA.data.body.state = 'needs-inline';
        }
        else {
            if(body.hasClass('needs-inline')) {
                body.removeClass('needs-inline');
            }
            body.addClass('needs-page');
            NA.data.body.state = 'needs-page';
        }

    });

    NA.fn.addObjectEvent("change", $(".needs-analyzer .children-select").not(".page-inline .children-select"), function(event) {


        var buildChildren = function(target) {

            var newNumberOfChildren = $(target).val(),
                formInlineContainer,
                formGroupContainer,
                ageContainer,
                collegeTypeContainer,
                collegeCostContainer;

            // NA.collegeChildren = [];

            NA.childrenContainer = $('.children-container');
            NA.childrensTotalContainer = $('.childrens-total-container');
            NA.childrensTotalDisplay = $('.childrens-totals');

            NA.childrensTotalContainer.hide();

            if (newNumberOfChildren > 0) {

                var createHowMany = 0;
                var removeHowMany = 0;

                NA.childrensTotalContainer.show();

                if (newNumberOfChildren > NA.numberChilden) {
                    createHowMany = newNumberOfChildren - NA.numberChilden;
                    createHowMany = (NA.numberChilden + createHowMany)

                    var collgeBuilder = function(nthChild) {

                        var buildAge = function() {
                            NA.ageSelect = NA.fn.createSelect(['Age', '1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12', '13', '14', '15', '16', '17', '18', '19', '20', '21'], ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12', '13', '14', '15', '16', '17', '18', '19', '20', '21'], {
                                class: 'form-control age input-md college-attr',
                                'data-child': nthChild,
                                'data-type-attrib': 'age'
                            });

                            var inputGroup = NA.fn.createElem('div', {
                                class: 'mini-input-group'
                            });
                            inputGroup.append(NA.ageSelect);

                            return inputGroup;
                        };

                        var buildCollegeType = function() {
                            NA.collegeType = NA.fn.createSelect(['College Type', 'Public', 'Private'], ['0', '84816', '180680'], {
                                class: 'form-control input-md college-attr mini-control',
                                'data-child': nthChild,
                                'data-type-attrib': 'collegeType'
                            });

                            var inputGroup = NA.fn.createElem('div', {
                                class: 'mini-input-group'
                            });
                            inputGroup.append(NA.collegeType);

                            return inputGroup;
                        };

                        var buildCollegeCost = function() {
                            NA.collegeCost = NA.fn.createElem('input', {
                                class: 'mini-form-control input-md mini-control',
                                placeholder: '$0.00',
                                'data-child': nthChild,
                                'data-type-attrib': 'collegeCost',
                                value: 0.00
                            });
                            NA.collegeCost.prop('readonly', true);

                            var inputGroup = NA.fn.createElem('div', {
                                class: 'mini-input-group collegeAmt'
                            })
                                .append(NA.fn.createElem('div', {
                                    class: 'input-group-addon'
                                }).append(NA.fn.createElem('i', {
                                    class: 'fa fa-dollar'
                                })));

                            inputGroup.append(NA.collegeCost);

                            return inputGroup;
                        };

                        ageContainer = buildAge();
                        collegeTypeContainer = buildCollegeType();
                        collegeCostContainer = buildCollegeCost();

                    }

                    for (var i = NA.numberChilden; i < createHowMany; i++) {


                        // console.log("numberChilden: " + NA.numberChilden);

                        collgeBuilder(i);

                        NA.collegeChildren.push({
                            age: NA.ageSelect,
                            collgeType: NA.collegeType,
                            collegeCost: NA.collegeCost,
                            data: {
                                age: 0,
                                collegeType: '',
                                collegeCost: 0.00,
                                originalCost: 0.00,
                            }
                        });

                        NA.childContainer = NA.fn.createElem('div', {
                            class: 'child-container'
                        })

                        formInlineContainer = NA.fn.createElem('div', {
                            class: 'form-inline'
                        });

                        formGroupContainer = NA.fn.createElem('div', {
                            class: 'form-group'
                        });

                        NA.childContents = 'Children: ' + NA.numberChilden;

                        formGroupContainer.append(ageContainer);
                        formGroupContainer.append(collegeTypeContainer);
                        formGroupContainer.append(collegeCostContainer);

                        formInlineContainer.append(formGroupContainer);
                        NA.childContainer.append(formInlineContainer);
                        NA.childrenContainer.append(NA.childContainer);

                        NA.numberChilden = NA.numberChilden + 1;
                    }

                }
                else {
                    removeHowMany = NA.numberChilden - newNumberOfChildren;
                    var removeUntil = NA.numberChilden - removeHowMany;
                    var index = NA.numberChilden - 1;

                    for (var ii = NA.numberChilden; ii > removeUntil; ii--) {
                        // go deep up to delete parent
                        // parent().parent().parent().parent()
                        NA.collegeChildren[index].age.parent().parent().parent().parent().remove();
                        // delete NA.collegeChildren[index];
                        NA.collegeChildren.splice(index, 1);
                        NA.numberChilden = NA.numberChilden - 1;
                        index = NA.numberChilden - 1;
                    }

                    NA.data.college.update.call(NA.data);

                }

                NA.fn.addEvent("change", ".needs-analyzer .college-attr", function(event) {

                    var
                        type,
                        childPos,
                        childAge = 0,
                        collegeType = '',
                        collegeCost = 0.00,
                        yearsTilCollege = 0,
                        totalCollegeCosts = 0.00,
                        collegeCostStr = '',
                        currentChild = NA.collegeChildren[childPos];

                    type = $(this).data('typeAttrib');
                    childPos = $(this).data('child');

                    switch (type) {
                        case 'age':
                            childAge = $(this).val();
                            NA.collegeChildren[childPos].data.age = childAge;
                            break;

                        case 'collegeType':
                            collegeType = $(this).text();
                            collegeCost = $(this).val();

                            NA.collegeChildren[childPos].data.originalCost = collegeCost;
                            NA.collegeChildren[childPos].data.collegeType = collegeType;
                            NA.collegeChildren[childPos].data.collegeCost = collegeCost;

                            break;

                        default:
                    }

                    collegeCostStr = NAUtils.fn.cleanParseFloat( NA.collegeChildren[childPos].data.originalCost );

                    if (NA.collegeChildren[childPos].data.age > 0 && parseFloat(collegeCostStr) > 0) {

                        if (parseInt(NA.collegeChildren[childPos].data.age) < 18) {
                            yearsTilCollege = 18 - parseInt(NA.collegeChildren[childPos].data.age);
                        } else {
                            yearsTilCollege = 0;
                        }

                        NA.collegeChildren[childPos].data.collegeCost = NA.data.college.calculate(collegeCostStr, NA.data.college.inflationRate, yearsTilCollege, 4);

                        NA.collegeChildren[childPos].collegeCost.prop('readonly', false);
                        NA.collegeChildren[childPos].collegeCost.val(NA.collegeChildren[childPos].data.collegeCost);
                        NA.collegeChildren[childPos].collegeCost.prop('readonly', true);

                        NA.data.college.update.call( NA.data );
                    }
                });

            }
            else {

                NA.childrenContainer = $('.children-container');
                NA.childrensTotalContainer = $('.childrens-total-container');
                NA.childrensTotalDisplay = $('.childrens-totals');
                NA.childrensTotalDisplay.html("$0.00");
                NA.childrensTotalContainer.hide();
                NA.childrenContainer.empty();
                NA.numberChilden = 0;
                NA.data.college.update.call( NA.data );
                NA.collegeChildren = [];
            }

        }

        buildChildren(this);


        return false;
    });


    NA.fn.addEvent("change", ".page-inline .children-select", function(event) {


        var buildChildren = function(target) {

            var newNumberOfChildren = $(target).val(),
                formInlineContainer,
                formGroupContainer,
                ageContainer,
                collegeTypeContainer,
                collegeCostContainer;

            // NA.collegeChildren = [];

            NA.childrenContainer = $('.page-inline .children-container');
            NA.childrensTotalContainer = $('.page-inline .childrens-total-container');
            NA.childrensTotalDisplay = $('.page-inline .childrens-totals');

            NA.childrensTotalContainer.hide();

            if (newNumberOfChildren > 0) {

                var createHowMany = 0;
                var removeHowMany = 0;

                NA.childrensTotalContainer.show();

                if (newNumberOfChildren > NA.numberChildenInline) {
                    createHowMany = newNumberOfChildren - NA.numberChildenInline;
                    createHowMany = (NA.numberChildenInline + createHowMany)

                    var collgeBuilder = function(nthChild) {

                        var buildAge = function() {
                            NA.ageSelect = NA.fn.createSelect(['Age', '1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12', '13', '14', '15', '16', '17', '18', '19', '20', '21'], ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12', '13', '14', '15', '16', '17', '18', '19', '20', '21'], {
                                class: 'form-control age input-md college-attr',
                                'data-child': nthChild,
                                'data-type-attrib': 'age'
                            });

                            var inputGroup = NA.fn.createElem('div', {
                                class: 'mini-input-group age'
                            });
                            inputGroup.append(NA.ageSelect);

                            return inputGroup;
                        };

                        var buildCollegeType = function() {
                            NA.collegeType = NA.fn.createSelect(['College Type', 'Public', 'Private'], ['0', '84816', '180680'], {
                                class: 'form-control collegeType input-md college-attr mini-control',
                                'data-child': nthChild,
                                'data-type-attrib': 'collegeType'
                            });

                            var inputGroup = NA.fn.createElem('div', {
                                class: 'mini-input-group collegeAmt'
                            });
                            inputGroup.append(NA.collegeType);

                            return inputGroup;
                        };

                        var buildCollegeCost = function() {
                            NA.collegeCost = NA.fn.createElem('input', {
                                type: 'text',
                                class: 'mini-form-control input-md mini-control collegeAmt',
                                placeholder: '$0.00',
                                'data-child': nthChild,
                                'data-type-attrib': 'collegeCost',
                                value: 0.00
                            });
                            NA.collegeCost.prop('readonly', true);

                            var inputGroup = NA.fn.createElem('div', {
                                class: 'mini-input-group collegeAmt'
                            })
                                .append(NA.fn.createElem('div', {

                                    class: 'input-group-addon collegeAmt'
                                }).append(NA.fn.createElem('i', {
                                    class: 'fa fa-dollar'
                                })));

                            inputGroup.append(NA.collegeCost);

                            return inputGroup;
                        };

                        ageContainer = buildAge();
                        collegeTypeContainer = buildCollegeType();
                        collegeCostContainer = buildCollegeCost();

                    }

                    for (var i = NA.numberChildenInline; i < createHowMany; i++) {


                        // console.log("numberChilden: " + NA.numberChildenInline);

                        collgeBuilder(i);

                        NA.collegeChildrenInline.push({
                            age: NA.ageSelect,
                            collgeType: NA.collegeType,
                            collegeCost: NA.collegeCost,
                            data: {
                                age: 0,
                                collegeType: '',
                                collegeCost: 0.00,
                                originalCost: 0.00,
                            }
                        });

                        NA.childContainer = NA.fn.createElem('div', {
                            class: 'child-container'
                        })

                        formInlineContainer = NA.fn.createElem('div', {
                            class: 'form-inline'
                        });

                        formGroupContainer = NA.fn.createElem('div', {
                            class: 'form-group'
                        });

                        NA.childContents = 'Children: ' + NA.numberChildenInline;

                        formGroupContainer.append(ageContainer);
                        formGroupContainer.append(collegeTypeContainer);
                        formGroupContainer.append(collegeCostContainer);

                        formInlineContainer.append(formGroupContainer);
                        NA.childContainer.append(formInlineContainer);
                        NA.childrenContainer.append(NA.childContainer);

                        NA.numberChildenInline = NA.numberChildenInline + 1;
                    }

                }
                else {
                    removeHowMany = NA.numberChildenInline - newNumberOfChildren;
                    var removeUntil = NA.numberChildenInline - removeHowMany;
                    var index = NA.numberChildenInline - 1;

                    for (var ii = NA.numberChildenInline; ii > removeUntil; ii--) {
                        // go deep up to delete parent
                        // parent().parent().parent().parent()
                        NA.collegeChildrenInline[index].age.parent().parent().parent().parent().remove();
                        // delete NA.collegeChildrenInline[index];
                        NA.collegeChildrenInline.splice(index, 1);
                        NA.numberChildenInline = NA.numberChildenInline - 1;
                        index = NA.numberChildenInline - 1;
                    }

                    NA.data.college.update.call(NA.data);

                }

                NA.fn.addEvent("change", ".page-inline .college-attr", function(event) {

                    var
                        type,
                        childPos,
                        childAge = 0,
                        collegeType = '',
                        collegeCost = 0.00,
                        yearsTilCollege = 0,
                        totalCollegeCosts = 0.00,
                        collegeCostStr = '',
                        currentChild = NA.collegeChildrenInline[childPos];

                    type = $(this).data('typeAttrib');
                    childPos = $(this).data('child');

                    switch (type) {
                        case 'age':
                            childAge = $(this).val();
                            NA.collegeChildrenInline[childPos].data.age = childAge;
                            break;

                        case 'collegeType':
                            collegeType = $(this).text();
                            collegeCost = $(this).val();

                            NA.collegeChildrenInline[childPos].data.originalCost = collegeCost;
                            NA.collegeChildrenInline[childPos].data.collegeType = collegeType;
                            NA.collegeChildrenInline[childPos].data.collegeCost = collegeCost;

                            break;

                        default:
                    }

                    collegeCostStr = NAUtils.fn.cleanParseFloat( NA.collegeChildrenInline[childPos].data.originalCost );

                    if (NA.collegeChildrenInline[childPos].data.age > 0 && parseFloat(collegeCostStr) > 0) {

                        if (parseInt(NA.collegeChildrenInline[childPos].data.age) < 18) {
                            yearsTilCollege = 18 - parseInt(NA.collegeChildrenInline[childPos].data.age);
                        } else {
                            yearsTilCollege = 0;
                        }

                        NA.collegeChildrenInline[childPos].data.collegeCost = NA.data.college.calculate(collegeCostStr, NA.data.college.inflationRate, yearsTilCollege, 4);

                        NA.collegeChildrenInline[childPos].collegeCost.prop('readonly', false);
                        NA.collegeChildrenInline[childPos].collegeCost.val(NA.collegeChildrenInline[childPos].data.collegeCost);
                        NA.collegeChildrenInline[childPos].collegeCost.prop('readonly', true);

                        NA.data.college.update.call( NA.data );
                    }
                });

            }
            else {

                NA.childrenContainer = $('.page-inline .children-container');
                NA.childrensTotalContainer = $('.page-inline .childrens-total-container');
                NA.childrensTotalDisplay = $('.page-inline .childrens-totals');
                NA.childrensTotalDisplay.html("$0.00");
                NA.childrensTotalContainer.hide();
                NA.childrenContainer.empty();
                NA.numberChildenInline = 0;
                NA.data.college.update.call( NA.data );
                NA.collegeChildrenInline = [];
            }

        }

        buildChildren(this);


        return false;
    });

    var newNA = NA.extend({
        myName: 'test1'
    });
});


window.fd3 = {

    init: function() {
        /* If the bookmarklet already exists on the page, remove it */
        var bookmarklet = document.getElementById('fd3-browserTools');

        if (bookmarklet) {
            document.body.removeChild(bookmarklet);
        }

        fd3.version = 'fd3-2.0.0';

        fd3.postionTmpl =
            "<pre id=\"fd3-mousePosition\"></pre>";

        fd3.mqTmpl =
            "<div id=\"mqb-linksContainer\">" +
            "</div>" +
            "<ol id=\"fd3-queries\"></ol>";

        fd3.rulersTmpl =
            "<div id=\"fd3-horz-ruler\">" +
            "  <div id=\"fd3-mouseXPosition\">" +
            "</div>" +
            "<div id=\"fd3-vert-ruler\">" +
            "  <div id=\"fd3-mouseYPosition\">" +
            "</div>";

        fd3.tmpl =
            "<pre id=\"fd3-dimensions\"></pre>" +
            //  "<ol id=\"fd3-queries\"></ol>" +
            "<!-- <div id=\"fd3-linksContainer\">" +
            "  <button id=\"fd3-closeButton\">close</button>" +
            "  <button id=\"fd3-positionButton\"></button>" +
            "</div> -->";

        fd3.rulers = document.getElementById("sb-rulers");
        fd3.emTest = document.createElement("div");
        fd3.emTest.id = "fd3-emTest";
        document.body.appendChild(fd3.emTest);

        fd3.loadCSS();
        fd3.createTemplate();

        fd3.mqList = [];

        fd3.createMQList();

        window.addEventListener('resize', function() {
            fd3.showCurrentSize();
            if (window.matchMedia) {
                fd3.mqChange();
            }
        }, false);
        fd3.mqChange();

        fd3.initEmSize();
    },

    positionDisplay: function() {
        fd3.container = document.createElement("pre");
        fd3.container.id = "fd3-mousePosition";
        fd3.container.className = "onLeft";
        fd3.container.innerHTML = fd3.postionTmpl;
        document.body.appendChild(fd3.container);
    },

    mqDisplay: function() {
        fd3.container = document.createElement("div");
        fd3.container.id = "fd3-mq";
        fd3.container.className = "onRight";
        fd3.container.innerHTML = fd3.mqTmpl;
        document.body.appendChild(fd3.container);
    },

    appendDisplay: function() {
        fd3.container = document.createElement("div");
        fd3.container.id = "fd3-browserTools";
        fd3.container.className = "onRight";
        fd3.container.innerHTML = fd3.tmpl;
        document.body.appendChild(fd3.container);

        fd3.appendRulers();
        fd3.attachEvents();
    },

    appendRulers: function() {
        fd3.rulers = document.createElement("div");
        fd3.rulers.id = "sb-rulers";
        fd3.rulers.innerHTML = fd3.rulersTmpl;
        document.body.appendChild(fd3.rulers);

        fd3.mouseXPosition = document.getElementById("fd3-mouseXPosition");
        fd3.mouseYPosition = document.getElementById("fd3-mouseYPosition");
        fd3.showMousePosition = document.getElementById("fd3-mousePosition");
    },

    attachEvents: function() {
        /* Close Button */
        /*
         document.getElementById("fd3-closeButton").addEventListener("click", function(e) {
         fd3.close(e);
         fd3 = null;
         });
         */


        /* Position Button */
        /*
         document.getElementById("fd3-positionButton").addEventListener('click', function(e) {
         if (fd3.container.className == "onLeft") {
         fd3.container.className = "onRight";
         } else {
         fd3.container.className = "onLeft";
         }
         });
         */
        document.addEventListener('mousemove', fd3.showCurrentMousePos);
    },

    close: function(e) {
        e.preventDefault();

        document.body.removeChild(fd3.container);
        document.body.removeChild(fd3.emTest);
        document.body.removeChild(fd3.rulers);
        document.head.removeChild(fd3.css);

        for (var i in fd3.guideStyles) {
            document.head.removeChild(fd3.guideStyles[i]);
        }

        document.removeEventListener('mousemove', fd3.showCurrentMousePos);
    },

    createMQList: function() {
        var mqs = this.getMediaQueries(),
            links = document.getElementsByTagName('link'),
            i;

        for (i = mqs.length - 1; i >= 0; i--) {
            if (!this.inList(mqs[i])) {
                fd3.log( window.matchMedia(mqs[i]) );
                this.mqList.push(window.matchMedia(mqs[i]));
            }
        }

        for (i = links.length - 1; i >= 0; i--) {
            if (links[i].media !== '') {
                fd3.log( window.matchMedia(links[i].media) );
                this.mqList.push(window.matchMedia(links[i].media));
            }
        }
    },

    createTemplate: function() {
        fd3.positionDisplay();
        fd3.mqDisplay();
        fd3.appendDisplay();
        fd3.viewDimensions = document.getElementById("fd3-dimensions");
        fd3.viewQueries = document.getElementById("fd3-queries");
        //  fd3.tmplReplace("fd3-version", "version " + fd3.version);
        fd3.showCurrentSize();
    },

    findEmSize: function() {
        return fd3.emTest.clientWidth;
    },

    getMediaQueries: function() {
        var sheetList = document.styleSheets,
            ruleList,
            i, j,
            mediaQueries = [];

        for (i = sheetList.length - 1; i >= 0; i--) {
            try {
                ruleList = sheetList[i].cssRules;
                if (ruleList) {
                    for (j = 0; j < ruleList.length; j++) {
                        if (ruleList[j].type == CSSRule.MEDIA_RULE) {
                            mediaQueries.push(ruleList[j].media.mediaText);
                        }
                    }
                }
            } catch (e) {}
        }
        return mediaQueries;
    },

    initEmSize: function() {
        fd3.cssTimer = setTimeout(function() {
            if (fd3.emTest.clientWidth === 0) {
                fd3.initEmSize();
            } else {
                fd3.showCurrentSize();
            }
        }, 250);
    },

    inList: function(media) {
        for (var i = this.mqList.length - 1; i >= 0; i--) {
            if (this.mqList[i].media === media) {
                return true;
            }
        }
        return false;
    },

    loadCSS: function() {
        fd3.css = document.createElement('link');
        fd3.css.type = "text/css";
        fd3.css.rel = "stylesheet";
        //   fd3.css.href = "http://sparkbox.github.com/mediaQueryBookmarklet/stylesheets/mediaQuery.css";
        document.head.appendChild(fd3.css);
    },

    mqChange: function() {
        var html = '';

        for (var i in fd3.mqList) {
            if (fd3.mqList[i].matches) {
                html += "<li><span>" + fd3.mqList[i].media + "</span></li>";
            }
        }
        fd3.viewQueries.innerHTML = html;
    },

    log: function(m) {
        if(window.console) {
            // console.log( m );
        }
    },

    showCurrentSize: function() {
        var width = window.innerWidth || window.outerWidth;
        var height = window.innerHeight || window.outerHeight;
        var str;
        str = width + ',' + height + '(px)\n\n' + (width / fd3.findEmSize()).toPrecision(4) + ',' + (height / fd3.findEmSize()).toPrecision(4) + '(em)';
        fd3.log( str );
        fd3.viewDimensions.innerHTML = str;
    },

    tmplReplace: function(dstID, src) {
        document.getElementById(dstID).innerHTML = src;
    },

    showCurrentMousePos: function(e) {
        var str;
        fd3.mouseXPosition.style.left = e.clientX + "px";
        fd3.mouseYPosition.style.top = e.clientY + "px";
        str = "(x:" + e.clientX + ", y:" + e.clientY + ")(px)";
        fd3.log( str );
        fd3.showMousePosition.innerHTML = str;
    }

};

// fd3.init();
