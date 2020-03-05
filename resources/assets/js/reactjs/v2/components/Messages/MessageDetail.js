import React from 'react';
import PropTypes from 'prop-types';
import {render} from "react-dom";

/** function: MessageDetail */
const MessageDetail = ({message}) => {

    return (
            <div className="row">
                <div className="col-md-12 mb-3">
                    <label htmlFor="firstName" className="details-field">Name</label>
                    <div className="form-control" id="firstName">{message.name}</div>
                </div>
                <div className="col-md-12 mb-3">
                    <label htmlFor="lastName" className="details-field">Phone</label>
                    <div className="form-control" id="lastName">{message.phone}</div>
                </div>
                <div className="col-md-12 mb-3">
                    <label htmlFor="lastName" className="details-field">Email</label>
                    <div className="form-control" id="lastName">{message.email}</div>
                </div>
                <div className="col-md-12 mb-3">
                    <label htmlFor="lastName" className="details-field">Message</label>
                    <div className="form-control textarea-message" id="lastName">{ message.message }</div>
                </div>
            </div>

    );
};

MessageDetail.propTypes = {
    message: PropTypes.object.isRequired
};

MessageDetail.defaultProps = {
    message: { name: 'John Smith', phone: '5551212', email: 'jsmith@gmail.comi', message: 'test message.' }
};

export default MessageDetail;