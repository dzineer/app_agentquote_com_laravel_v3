import React from 'react';
import PropTypes from 'prop-types';

/** function: Table */
const Table = ({className, children, ...props}) => {
    return (
        <table className={className} {...props} >{ children }</table>
    );
};

Table.propTypes = {
  className: PropTypes.string,
  children: PropTypes.string.isRequired
};

export default Table;