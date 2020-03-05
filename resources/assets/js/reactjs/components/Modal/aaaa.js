import React, { Component } from 'react';
import PropTypes from 'prop-types';
import TextInput from "../TextInput/TextInput";

/** function: ContactMeModal */
class ContactMeModal extends Component {
    constructor(props) {
        super(props);
        this.state = {
            contact: {
                recipient_name: '',
                recipient_phone: '',
                recipient_email: '',
                recipient_message: ''
            }
        }
    }

    onChange = event => {
        const newState = Object.assign({}, this.state.contact, { [event.target.net]: event.target.value });
        this.setState({
            contact: newState
        });
    };

    onSubmit = event => {
        event.preventDefault();
        console.log(this.state.contact);
    };

    render() {

        const { label, from, email } = this.props;

        const styles = {
            for: {
                label: {
                    textAlign: 'left',
                    width: '100%'
                },
                modalTitle: {
                    width: '100%'
                }
            }
        };

        const modal_header = (
            <div className="modal-header">
            <h5 className="modal-title text-center" id="" style={styles.for.modalTitle}>Please be
        sure to fill out the fields below:</h5>
        <button type="button" className="close" data-dismiss="ContactMeModal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
        </div>
    );

        const fields = [
            {name: 'recipient_name', label: 'Name', type: 'single'},
            {name: 'recipient_phone', label: 'Phone', type: 'single'},
            {name: 'recipient_email', label: 'Email', type: 'single'},
            {name: 'recipient_message', label: 'Message', type: 'block', rows: 5}
        ];

        const form_fields = fields.map(field => {
            return field.type === 'single' ?
                <TextInput
                    key={Math.floor(Math.random() * 20)}
            name={name}
            label={field.label}
            required={false}
            styles={styles.for.label}
            onChange={this.onChange}
            />
        :
            <div className="form-group" key={Math.floor(Math.random() * 20)}>
            <label htmlFor="message-text" className="col-form-label"
            style={styles.for.label}>{field.label}</label>
            <textarea className="form-control" id={name} name={name} rows={field.rows}/>
            </div>
        });

        const modal_body = (
            <div className="modal-body">
                <form>
                    {form_fields}
                </form>
                </div>
        );

        const modal_footer = (
            <div className="modal-footer">
            <button type="button" className="btn btn-secondary" data-dismiss="ContactMeModal">Close</button>
            <button type="button" className="btn btn-primary">Send message</button>
        </div>
    );

        const modal_window = (
            <div>
                <a href="#" className="btn btn-primary btn-lg" data-toggle="ContactMeModal"
        data-target="#ContactMeModal" data-whatever="@mdo">{label}</a>

            <div className="modal fade" id="ContactMeModal" tabIndex="-1" role="dialog"
        aria-labelledby="exampleContactMeModalLabel" aria-hidden="true">
        <div className="modal-dialog modal-lg" role="document">
        <div className="modal-content">
            {modal_header}
        {modal_body}
        {modal_footer}
        </div>
        </div>
        </div>
        </div>

    );

        return (
            <div>
                {modal_window}
            </div>
        );
    }
}

ContactMeModal.propTypes = {
    label: PropTypes.string,
    from: PropTypes.string,
    email: PropTypes.string
};

ContactMeModal.defaultProps = {
    //myProp: val
};

export default ContactMeModal;