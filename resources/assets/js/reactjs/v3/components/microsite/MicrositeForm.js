import React, { Component } from 'react';
import ReactDom from "react-dom";
import SelectInput from '../SelectInput';
import CheckBoxInput from '../CheckBoxInput';
import Error from '../Error';
import ContentForm from "../common/ContentForm";
import TextInput from "../TextInput/TextInput";
import toastr from "toastr";
import { ChromePicker } from 'react-color';
import Sketch from "../ColorPicker/Sketch";
import SketchInLine from "../ColorPicker/SketchInLine";
import SwatchContainer from "../ColorPicker/SwatchContainer";

/** function: MicrositeForm */
class MicrositeForm extends Component {
    // console.log('CourseForm', [course, allAuthors, onSave, onChange, saving, errors])
    constructor(props) {
        super(props);

        this.state = {
            colors: {
                header_background: { r: '232', g: '232', b: '232', a: '1' },
                menu_bar: { r: '128', g: '128', b: '128', a: '1' },
                banner_form_background: { r: '238', g: '238', b: '238', a: '1' },
                rates_background: { r: '4', g: '173', b: '249', a: '1' }
            },
            defaults: {
                colors: {
                    header_background: { r: '232', g: '232', b: '232', a: '1' },
                    menu_bar: { r: '128', g: '128', b: '128', a: '1' },
                    banner_form_background: { r: '238', g: '238', b: '238', a: '1' },
                    rates_background: { r: '4', g: '173', b: '249', a: '1' }
                }
            },
            microsite: {
                id: 0,
                subdomain: '',
                default_category_id: 1,
                show_logo: false,
                show_portrait: false,
                colors: {
                    header_background: { r: '241', g: '112', b: '19', a: '1' },
                    menu_bar: { r: '241', g: '112', b: '19', a: '1' },
                    banner_form_background: { r: '241', g: '112', b: '19', a: '1' },
                    rates_background: { r: '241', g: '112', b: '19', a: '1' }
                }
            },
            submit: {
                disabled: false,
                caption: 'Save',
                normal: 'Save',
                onSave: 'Saving...'
            }
        };

        this.userId = user_id;
        this.token = jQuery('meta[name="csrf-token"]').attr('content')

        axios.defaults.headers.common = {
            'X-Requested-With': 'XMLHttpRequest',
            'X-CSRF-TOKEN': this.token
        };

        toastr.options = {
            "debug": false,
            "positionClass": "toast-bottom-right",
            "onclick": null,
            "fadeIn": 300,
            "fadeOut": 1000,
            "timeOut": 5000,
            "extendedTimeOut": 21000
        };

        this.options = [
            {text: 'Term Life', value: 1},
            {text: 'Simplified Issue Term', value: 2},
            {text: 'Simplified Issue Whole Life', value: 3},
            {text: 'Guaranteed Universal Life', value: 4}
        ];

    }

    componentDidMount() {
        console.log("Component Did Mount");
        // debugger;
        this.getMicrosite();
    }

    getMicrosite = () => {
        axios.get('/user/' + this.userId + '/microsite').then( res => {
            let microsite = {
                id: res.data.id,
                subdomain: res.data.subdomain,
                default_category_id: res.data.default_category_id,
                show_logo: res.data.show_logo === 1,
                show_portrait: res.data.show_portrait === 1,
                colors: {
                    header_background: JSON.parse(res.data.colors.header_background),
                    menu_bar: JSON.parse(res.data.colors.menu_bar),
                    banner_form_background: JSON.parse(res.data.colors.banner_form_background) ,
                    rates_background: JSON.parse(res.data.colors.rates_background),
                }
            };

            let newState = Object.assign({}, this.state);

            newState.colors = microsite.colors;
            newState.microsite.id = microsite.id;
            newState.microsite.subdomain = microsite.subdomain;
            newState.microsite.show_logo = microsite.show_logo;
            newState.microsite.show_portrait = microsite.show_portrait;
            newState.microsite.default_category_id = microsite.default_category_id;
            newState.microsite.colors = microsite.colors;

            this.setState(newState);
            let ss = 1;

        }).catch( error => {
            console.log(error);
            this.setState({
                error: error
            });
        });
    };

    updateCheckedHandler = event => {
        console.log(event.target.value);
        const newState = Object.assign({}, this.state.microsite, { [event.target.name]: event.target.checked });
        this.setState({ microsite: newState });
    };

    updateHandler = event => {
        console.log(event.target.value);
        const newState = Object.assign({}, this.state.microsite, { [event.target.name]: event.target.value });
        this.setState({ microsite: newState });
    };

    updateColorHandler = (name, color) => {
        console.log(color, name);
        let newColor = `rgba(${ color.r }, ${ color.g }, ${ color.b }, ${ color.a })`;
        const newState = Object.assign({}, this.state);
        newState.microsite[name] = newColor;
        newState.colors[name] = color;
        // debugger;
        this.setState(newState);
    };

    onReset = event => {
        event.preventDefault();
        let newHeaderBackground = 'rgba(' + this.state.defaults.colors.header_background.r + ','
                                           + this.state.defaults.colors.header_background.g + ','
                                           + this.state.defaults.colors.header_background.b + ','
                                           + this.state.defaults.colors.header_background.a + ')';

        let newMenuBarBackground = 'rgba(' + this.state.defaults.colors.menu_bar.r + ','
            + this.state.defaults.colors.menu_bar.g + ','
            + this.state.defaults.colors.menu_bar.b + ','
            + this.state.defaults.colors.menu_bar.a + ')';

        let newBannerFormBackground = 'rgba(' + this.state.defaults.colors.banner_form_background.r + ','
            + this.state.defaults.colors.banner_form_background.g + ','
            + this.state.defaults.colors.banner_form_background.b + ','
            + this.state.defaults.colors.banner_form_background.a + ')';

        let newRatesBackground = 'rgba(' + this.state.defaults.colors.rates_background.r + ','
            + this.state.defaults.colors.rates_background.g + ','
            + this.state.defaults.colors.rates_background.b + ','
            + this.state.defaults.colors.rates_background.a + ')';

        const newState = Object.assign({}, this.state);

        newState.microsite.colors.header_background = newHeaderBackground;
        newState.microsite.colors.menu_bar = newMenuBarBackground;
        newState.microsite.colors.banner_form_background = newBannerFormBackground;
        newState.microsite.colors.rates_background = newRatesBackground;

        newState.colors.header_background = this.state.defaults.colors.header_background;
        newState.colors.menu_bar = this.state.defaults.colors.menu_bar;
        newState.colors.banner_form_background = this.state.defaults.colors.banner_form_background;
        newState.colors.rates_background = this.state.defaults.colors.rates_background;

        this.setState(newState);
    };

    updateMicrositeHandler = event => {
        console.log(event);
        event.preventDefault();

        let fd = new FormData();

        if (this.state.microsite.subdomain) {
            fd.append('subdomain', this.state.microsite.subdomain);
        }

        if (this.state.microsite.default_category_id) {
            fd.append('default_category_id', this.state.microsite.default_category_id);
        }

        if (this.state.microsite.show_logo) {
            fd.append('show_logo', "1");
        } else {
            fd.append('show_logo', "0");
        }

        if (this.state.microsite.show_portrait) {
            fd.append('show_portrait', "1");
        } else {
            fd.append('show_portrait', "0");
        }

        if (this.state.microsite.show_logo) {
            fd.append('show_logo', "1");
        } else {
            fd.append('show_logo', "0");
        }

        if (this.state.colors.header_background) {
            fd.append('header_background', JSON.stringify(this.state.colors.header_background));
        }
        if (this.state.colors.menu_bar) {
            fd.append('menu_bar', JSON.stringify(this.state.colors.menu_bar));
        }
        if (this.state.colors.banner_form_background) {
            fd.append('banner_form_background', JSON.stringify(this.state.colors.banner_form_background));
        }
        if (this.state.colors.rates_background) {
            fd.append('rates_background', JSON.stringify(this.state.colors.rates_background));
        }

        if (this.state.microsite.id !== 0) {
            // already exists
            fd.append('_method', 'PUT');
            setTimeout(
                function() {
                    this.setState({
                        submit: Object.assign({}, this.state.submit, { caption: this.state.submit.onSave, disabled: true })
                    });
                }.bind(this), 1200
            );
            axios.post('/user/' + this.userId + '/microsite', fd).then( res => {
                if (res.data.success) {
                    setTimeout(
                        function() {
                            this.setState({
                                submit: Object.assign({}, this.state.submit, { caption: this.state.submit.normal, disabled: false })
                            });
                        }
                            .bind(this),
                        1200
                    );
                    toastr.success(res.data.message);
                } else if (res.data.failed) {
                    setTimeout(
                        function() {
                            this.setState({
                                submit: Object.assign({}, this.state.submit, { caption: this.state.submit.normal, disabled: false })
                            });
                        }
                            .bind(this),
                        1200
                    );
                    toastr.error(res.data.message);
                } else {
                    setTimeout(
                        function() {
                            this.setState({
                                submit: Object.assign({}, this.state.submit, { caption: this.state.submit.normal, disabled: false })
                            });
                        }
                            .bind(this),
                        1200
                    );
                    toastr.error(res.data.message);
                }
                console.log(res.data);
            }).catch( error => {
                this.setState({
                    submit: Object.assign({}, this.state.submit, { caption: this.state.submit.normal, disabled: false })
                });
                toastr.error("An error occurred, please try again later.");
                console.log(error);
            });
        } else {
            setTimeout(
                function() {
                    this.setState({
                        submit: Object.assign({}, this.state.submit, { caption: this.state.submit.onSave, disabled: true })
                    });
                }
                    .bind(this),
                1200
            );
            axios.post('/user/' + this.userId + '/microsite', fd).then( res => {
                if (res.data.success) {
                    setTimeout(
                        function() {
                            this.setState({
                                submit: Object.assign({}, this.state.submit, { caption: this.state.submit.normal, disabled: false })
                            });
                        }
                            .bind(this),
                        1200
                    );
                    toastr.success(res.data.message);
                } else if (res.data.failed) {
                    setTimeout(
                        function() {
                            this.setState({
                                submit: Object.assign({}, this.state.submit, { caption: this.state.submit.normal, disabled: false })
                            });
                        }
                            .bind(this),
                        1200
                    );
                    toastr.error(res.data.message);
                } else {
                    setTimeout(
                        function() {
                            this.setState({
                                submit: Object.assign({}, this.state.submit, { caption: this.state.submit.normal, disabled: false })
                            });
                        }
                            .bind(this),
                        1200
                    );
                    toastr.error(res.data.message);
                }
                console.log(res.data);
            }).catch( error => {
                this.setState({
                    submit: Object.assign({}, this.state.submit, { caption: this.state.submit.normal, disabled: false })
                });
                toastr.error("An error occurred, please try again later.");
                console.log(error);
            });
        }

    };

    render() {
        return (
            <ContentForm
                name="microsite-form"
                onClick={this.updateMicrositeHandler}
                buttonCaption={this.state.submit.caption}
                buttonState={this.state.submit.disabled} >

                <div className="row">
                    <div className="col-md-12">
                        <TextInput
                            name="subdomain"
                            label="Sub Domain"
                            value={this.state.microsite.subdomain}
                            onChange={this.updateHandler}
                        />

                        <SelectInput
                            label="Default Category"
                            name="default_category_id"
                            defaultOption=""
                            defaultValue={this.state.microsite.default_category_id.toString()}
                            required
                            options={this.options}
                            onChange={this.updateHandler}
                        />

                        <CheckBoxInput
                            name="show_logo"
                            label="Use Logo"
                            className="radio"
                            isChecked={this.state.microsite.show_logo}
                            onChange={this.updateCheckedHandler}
                        />

                        <CheckBoxInput
                            name="show_portrait"
                            label="Use Portrait"
                            className="radio"
                            value="1"
                            isChecked={this.state.microsite.show_portrait}
                            onChange={this.updateCheckedHandler}
                        />

                    </div>
                    <div className="col-md-12">
                        <Sketch name="header_background" label="Header background color" color={this.state.colors.header_background} onChange={this.updateColorHandler} />
                        <Sketch name="menu_bar" label="Menu color" color={this.state.colors.menu_bar} onChange={this.updateColorHandler} />
                        <Sketch name="banner_form_background" label="Banner form background color" color={this.state.colors.banner_form_background} onChange={this.updateColorHandler} />
                        <Sketch name="rates_background" label="Rates background color" color={this.state.colors.rates_background} onChange={this.updateColorHandler} />

                        <SwatchContainer name="swatch-container" label="Theme 1">
                            <SketchInLine name="color1" color={this.state.colors.header_background} />
                            <SketchInLine name="color2" color={this.state.colors.header_background} />
                            <SketchInLine name="color3" color={this.state.colors.header_background} />
                            <SketchInLine name="color4" color={this.state.colors.header_background} />
                        </SwatchContainer>

                        <SwatchContainer name="swatch-container" label="Theme 2">
                            <SketchInLine name="color1" color={this.state.colors.header_background} />
                            <SketchInLine name="color2" color={this.state.colors.header_background} />
                            <SketchInLine name="color3" color={this.state.colors.header_background} />
                            <SketchInLine name="color4" color={this.state.colors.header_background} />
                        </SwatchContainer>

                        <SwatchContainer name="swatch-container" label="Theme 3">
                            <SketchInLine name="color1" color={this.state.colors.header_background} />
                            <SketchInLine name="color2" color={this.state.colors.header_background} />
                            <SketchInLine name="color3" color={this.state.colors.header_background} />
                            <SketchInLine name="color4" color={this.state.colors.header_background} />
                        </SwatchContainer>

                        <SwatchContainer name="swatch-container" label="Theme 4">
                            <SketchInLine name="color1" color={this.state.colors.header_background} />
                            <SketchInLine name="color2" color={this.state.colors.header_background} />
                            <SketchInLine name="color3" color={this.state.colors.header_background} />
                            <SketchInLine name="color4" color={this.state.colors.header_background} />
                        </SwatchContainer>

                        <SwatchContainer name="swatch-container" label="Theme 5">
                            <SketchInLine name="color1" color={this.state.colors.header_background} />
                            <SketchInLine name="color2" color={this.state.colors.header_background} />
                            <SketchInLine name="color3" color={this.state.colors.header_background} />
                            <SketchInLine name="color4" color={this.state.colors.header_background} />
                        </SwatchContainer>

                        <br />
                        <br />
                        <input
                            type="submit"
                            value="Reset color"
                            className="btn btn-secondary" onClick={this.onReset}
                        />

                    </div>
                </div>

                <br />
            </ContentForm>
        );
    }

};

export default MicrositeForm;

if (document.getElementById('microsite')) {
    ReactDom.render(<MicrositeForm />,
        document.getElementById('microsite')
    );
}