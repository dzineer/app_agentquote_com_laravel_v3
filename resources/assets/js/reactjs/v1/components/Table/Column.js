import React from 'react';
import PropTypes from 'prop-types';

/** function: Column */
const Column = ({type, className, children, ...props}) => {
    return (
        type === 'td' ?
        <td className={ className } {...props} >{ children }</td>
        :
        <th className={ className } {...props} >{ children }</th>
    );
};

Column.propTypes = {
  type: PropTypes.oneOf(['td','th']),
  className: PropTypes.string,
  children: PropTypes.string.isRequired
};

export default Column;