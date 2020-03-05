import React from 'react';
import PropTypes from 'prop-types';

/** function: TableRow */
const TableRow = ({className, children, ...props}) => {
    return (
        <tr className={className} {...props} >{ children }</tr>
    );
};

TableRow.propTypes = {
  className: PropTypes.string,
  children: PropTypes.object.isRequired
};

export default TableRow;