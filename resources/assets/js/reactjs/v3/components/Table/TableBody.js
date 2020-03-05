import React from 'react';
import PropTypes from 'prop-types';

/** function: TableBody */
const TableBody = ({className, children, ...props}) => {
    return (
        <TableBody className={className} {...props} >{ children }</TableBody>
    );
};

TableBody.propTypes = {
  className: PropTypes.string,
  children: PropTypes.string.isRequired
};

export default TableBody;