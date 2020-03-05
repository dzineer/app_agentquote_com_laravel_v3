import React from 'react';
import PropTypes from 'prop-types';
import Column from "../Table/Column";
import TableRow from "../Table/TableRow";

/** function: Lead */
const Lead = ({id, first_name, last_name, email, phone, premium, ...props}) => {
    return (
            <tr>
                <th scope="row"><input type="checkbox" /></th>
                <th>1</th>
                <th>{ first_name }</th>
                <th>{ last_name }</th>
                <th>{ email }</th>
                <th>{ phone }</th>
                <th>${ premium }</th>
            </tr>
    );
};

Lead.propTypes = {
    id: PropTypes.string.isRequired,
    first_name: PropTypes.string.isRequired,
    last_name: PropTypes.string.isRequired,
    email: PropTypes.string.isRequired,
    phone: PropTypes.string.isRequired,
    premium: PropTypes.string.isRequired,
};

Lead.defaultProps = {

};

export default Lead;