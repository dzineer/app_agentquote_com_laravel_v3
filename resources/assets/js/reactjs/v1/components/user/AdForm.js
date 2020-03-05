import React, { Component } from 'react';
import TextInput from '../TextInput';
import ReactDom from "react-dom";
import toastr from "toastr";
import ContentForm from "../common/ContentForm";
import AdInput from "../AdInput/AdInput";

/** function: AdForm */
class AdForm extends Component {
    constructor(props) {
        super(props);

        this.state = {
            ad: 'Here is the Ad',
            submit: {
                disabled: false,
                caption: 'Change ad',
                normal: 'Change ad',
                onSave: 'Updating ad...'
            }
        };

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
    }

    updateHandler = event => {
        console.log(event.target.value);
        const newState = Object.assign({}, this.state, { [event.target.name]: event.target.value });
        this.setState(newState);
    };

    onSaveAd = event => {

        event.preventDefault();
        let fd = new FormData();

        if (!this.state.ad.length) {
            toastr.error("Please provide ad content.");
            return;
        }

        fd.append('ad', this.state.ad);
        fd.append('_method', 'PUT');

        setTimeout(
            function() {
                this.setState({
                    submit: Object.assign({}, this.state.submit, { caption: this.state.submit.onSave, disabled: true })
                });
            }.bind(this), 1200 );

        axios.post('/ad/' + this.userId + '/mast', fd).then( res => {
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
    };

    // console.log('CourseForm', [course, allAuthors, onSave, onChange, saving, errors])
    render() {

        return (
            <ContentForm
                name={"ad-form"}
                onClick={this.onSaveAd}
                buttonCaption={this.state.submit.caption}
                buttonState={this.state.submit.disabled} >

                <div className="form-group">
                    <label htmlFor="ad">Ad:</label>
                    <textarea className="form-control" id="ad" name="ad" rows="3">
                        This is my Ad.
                    </textarea>
                </div>

                <br />

            </ContentForm>
        );

    }
};

export default AdForm;

if (document.getElementById('ad-form')) {
    ReactDom.render(<AdForm errors={[]} />,
        document.getElementById('ad-form')
    );
}