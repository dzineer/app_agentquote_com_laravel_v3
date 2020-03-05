import React, { Component } from 'react';
import PropTypes from 'prop-types';
import TextInput from "../TextInput/TextInput";
import toastr from "toastr";

/** function: Modal */
class AppRequestModal extends Component {

    constructor(props) {
        super(props);

        this.state = {
            show_modal: true,
            contact: {
                name: '',
                phone: '',
                email: '',
                message: ''
            },
            submit: {
                disabled: false,
                caption: 'Save',
                done: 'Message Sent.',
                normal: 'Save',
                onSave: 'Sending...'
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

    onFormFieldChange = event => {
        const newState = Object.assign({}, this.state.contact, { [event.target.name]: event.target.value });
        this.setState({
            contact: newState
        });
    };

    onSubmit = event => {
        event.preventDefault();
        console.log(this.state.contact);

        let fd = new FormData();

        fd.append("name" , this.state.contact.name);
        fd.append("phone" , this.state.contact.phone);
        fd.append("email" , this.state.contact.email);
        fd.append("message" , this.state.contact.message);

        setTimeout(
            function() {
                this.setState({
                    submit: Object.assign({}, this.state.submit, { caption: this.state.submit.onSave, disabled: true })
                });
            }
                .bind(this),
            1200
        );

        axios.post('/user/messages', fd).then( res => {
            console.log(res);

            setTimeout(
                function() {
                    this.setState({
                        submit: Object.assign({}, this.state.submit, { caption: this.state.submit.done, disabled: false })
                    });
                }
                    .bind(this),
                1200
            );

            if (res.data.success) {
                this.setState({contact: {}, show_modal: false});
                toastr.success('Message was sent.');

            } else {
                this.setState({contact: {}, show_modal: false});
            }
        }).catch( error => {
            setTimeout(
                function() {
                    this.setState({
                        submit: Object.assign({}, this.state.submit, { caption: this.state.submit.normal, disabled: false })
                    });
                }
                    .bind(this),
                1200
            );
            console.log(error);
            this.setState({contact: {}, show_modal: false});
        });

    };

    render() {

        const {label, from, email} = this.props;

        const fields = [
            {name: 'email', label: 'Email', col: '6', type: 'single'},
            {name: 'phone', label: 'Phone', col: '6', type: 'single'},
            {name: 'fname', label: 'First Name', col: '6', type: 'single'},
            {name: 'lname', label: 'Last Name', col: '6', type: 'single'},
            {name: 'gender', label: 'Gender', col: '6', type: 'single'},
            {name: 'street', label: 'Street', col: '6', type: 'single'},
            {name: 'city', label: 'City', col: '6', type: 'single'},
            {name: 'state', label: 'State', col: '6', type: 'single'},
            {name: 'zipcode', label: 'Zip Code', col: '6', type: 'single'},
        ];

        const styles = {
            for: {
                label: {
                    textAlign: 'left',
                    width: '100%',
                    color: '#333 !important'
                },
                modalTitle: {
                    width: '100%',
                    textTransform: 'uppercase'
                }
            }
        };

        const form_fields = fields.map(field => {
            return field.type === 'single' ?
                <TextInput
                    key={field.name+field.label}
                    name={field.name}
                    id={name}
                    label={field.label}
                    className="field-label"
                    required={false}
                    styles={styles}
                    onChange={this.onFormFieldChange}
                />
                :
                <div className="form-group" key={field.name+field.label}>
                    <label htmlFor="message-text" className="field-label"
                           style={styles.for.label}>{field.label}</label>
                    <textarea className="form-control" id={field.name} name={field.name} rows={field.rows} onChange={this.onFormFieldChange} />
                </div>
        });

        const modal_header = (
            <div className="modal-header">
                <h5 className="modal-title" id="ModalLabel" style={styles.for.modalTitle}>Application Request Form</h5>
                <button type="button" className="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        );

        const modal_body = (
            <div className="modal-body">
                <div className="app-details">
                    <div><span className="app-header">Insurance Company:</span> Banner Life Insurance Company</div>
                    <div><span className="app-header">Name of Policy:</span> OPTerm 20</div>
                    <div><span className="app-header">Benefit Amount:</span> 600,000</div>
                    <div><span className="app-header">Term Length:</span> 20 Years</div>
                </div>

                <form>
                    <div className="input-group mb-3">
                        <div className="col-md-6 mb-2">
                            <label htmlFor="email" className="field-label">Email </label>
                            <div className="field"><input id="" className="form-control" name="email" value="" /></div>
                        </div>
                        <div className="col-md-6 mb-2">
                            <label htmlFor="phone" className="field-label">Phone </label>
                            <div className="field"><input id="" className="form-control" name="phone" value="" /></div>
                        </div>
                    </div>
                    <div className="input-group mb-3">
                        <div className="col-md-3 mb-2">
                            <label htmlFor="fname" className="field-label">First Name </label>
                            <div className="field"><input id="" className="form-control" name="fname" value="" /></div>
                        </div>
                        <div className="col-md-3 mb-2">
                            <label htmlFor="mname" className="field-label">Middle Name </label>
                            <div className="field"><input id="" className="form-control" name="mname" value="" /></div>
                        </div>
                        <div className="col-md-3 mb-2">
                            <label htmlFor="lname" className="field-label">Last Name </label>
                            <div className="field"><input id="" className="form-control" name="gender" value="" /></div>
                        </div>
                        <div className="col-md-3 mb-2">
                            <label htmlFor="gender" className="field-label">Gender </label>
                            <div className="field"><input id="" className="form-control" name="gender" value="" /></div>
                        </div>
                    </div>
                    <div className="input-group mb-3">
                        <div className="col-md-3 mb-2">
                            <label htmlFor="street" className="field-label">Street </label>
                            <div className="field"><input id="" className="form-control" name="street" value="" /></div>
                        </div>
                        <div className="col-md-3 mb-2">
                            <label htmlFor="city" className="field-label">City </label>
                            <div className="field"><input id="" className="form-control" name="city" value="" /></div>
                        </div>
                        <div className="col-md-3 mb-2">
                            <label htmlFor="state" className="field-label">State </label>
                            <div className="field"><input id="" className="form-control" name="state" value="" /></div>
                        </div>
                        <div className="col-md-3 mb-2">
                            <label htmlFor="zipcode" className="field-label">Zip Code </label>
                            <div className="field"><input id="" className="form-control" name="zipcode" value="" /></div>
                        </div>
                    </div>
                    <div className="input-group mt-5 mb-3">
                        <div className="col-md-6 mb-3">
                            <input id="clearButton" className="btn btn-warning btn-lg btn-long" name="CLEAR FORM" type="reset" value="CLEAR FORM" />
                        </div>
                        <div className="col-md-6 mb-3">
                            <input id="submitButton" className="btn btn-primary btn-lg btn-long" name="SUBMIT" type="submit" value="SUBMIT FORM" />
                        </div>
                    </div>
                    <p className="black-text">Rates shown are estimates, the actual premium will be determined after the underwriting process has been completed and may differ from the original quote. This quoting system is for rate comparisons only. This is not an offer or an illustration of life insurance. However, you may request an application by completing the appropriate application request form. This material briefly summarizes the product's features but is not a contract. You may review the actual contract terms, conditions and limitations by requesting a sample copy of the described policy.</p>
                </form>
            </div>
        );

        const modal_footer = (
            <div className="modal-footer">
                <button type="button" className="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" className="btn btn-primary" data-toggle="modal" data-target="#appRequestModel" data-whatever="@mdo" onClick={this.onSubmit}>Submit App</button>
            </div>
        );

        const modal_window = (
            this.state.show_modal && <div>
                <a href="#" className="btn btn-secondary btn-sm btn-orange" data-toggle="modal" data-target="#appRequestModel" data-whatever="@mdo">{label}</a>

                <div className="modal fade" id="appRequestModel" tabIndex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
                    <div className="modal-dialog modal-lg" role="document">
                        <div className="modal-content">
                            { modal_header }
                            { modal_body }
                            {/*{ modal_footer }*/}
                        </div>
                    </div>
                </div>
            </div>

        );

        return (
            <div>
                { modal_window }
            </div>
        );
    }

}

AppRequestModal.propTypes = {

};

AppRequestModal.defaultProps = {
    //myProp: val
};

export default AppRequestModal;