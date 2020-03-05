import React from 'react';
import PropTypes from 'prop-types';

/** function: Message */
const Message = ({id, full_name, email, phone, onCheck, message, date, ...props}) => {
    return (
            <tr>
                <td scope="row"><input  type="checkbox" onClick={(e) => onCheck(id, e)} /></td>
                <td>{ full_name }</td>
                <td>{ email }</td>
                <td>{ phone }</td>
                <td>{ message }</td>
                <td>{ date }</td>
            </tr>
    );
};

Message.propTypes = {
    id: PropTypes.number.isRequired,
    full_name: PropTypes.string.isRequired,
    email: PropTypes.string.isRequired,
    phone: PropTypes.string.isRequired,
    onCheck: PropTypes.func.isRequired,
    message: PropTypes.string.isRequired,
    date: PropTypes.string.isRequired
};

Message.defaultProps = {

};

export default Message;