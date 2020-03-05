import React from 'react';
import PropTypes from 'prop-types';

/** function: Columns */
const Columns = ({type, className, children, ...props}) => {
    return (
        type === 'td' ?
        <td className={ className } {props} >{ children }</td>
        :
        <th className={ className } {props} >{ children }</th>
    );
};

Columns.propTypes = {
  type: PropTypes.oneOf(['td','th']),
  className: PropTypes.string,
  children: PropTypes.string.isRequired
};

export default Columns;