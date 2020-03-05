import React from 'react';
import PropTypes from 'prop-types';

/** function: Contact */
const Contact = ({id, first_name, last_name, email, phone, addr1, addr2, city, state, zipcode, ...props}) => {
    return (
            <tr>
                <th scope="row"><input type="checkbox" /></th>
                <th><a href={id}>{id}</a></th>
                <th>{ first_name }</th>
                <th>{ last_name }</th>
                <th>{ email }</th>
                <th>{ phone }</th>
                <th>{ addr1 }</th>
                <th>{ addr2 }</th>
                <th>{ city }</th>
                <th>{ state }</th>
                <th>{ zipcode }</th>
            </tr>
    );
};

Contact.propTypes = {
    id: PropTypes.string.isRequired,
    first_name: PropTypes.string.isRequired,
    last_name: PropTypes.string.isRequired,
    email: PropTypes.string.isRequired,
    phone: PropTypes.string.isRequired,
    premium: PropTypes.string.isRequired,
};

Contact.defaultProps = {

};

export default Contact;