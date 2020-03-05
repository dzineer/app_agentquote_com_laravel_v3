import React from 'react';
import PropTypes from 'prop-types';

/** function: TableHead */
const TableHead = ({className, children, ...props}) => {
    return (
        <thead className={className} {...props} >{ children }</thead>
    );
};

TableHead.propTypes = {
  className: PropTypes.string,
  children: PropTypes.string.isRequired
};

export default TableHead;