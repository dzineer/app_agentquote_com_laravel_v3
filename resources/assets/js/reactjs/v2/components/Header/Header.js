import React from 'react';
import PropTypes from 'prop-types';

/** Header */
const Header = ({title, loading, ...props}) => {

    const css = {
        for: {
            header: {
              display: 'block',
              textAlign: 'center'
            }
        }
    };

    return (
        <h1 style={css.for.header}>{title}</h1>
    );
};

Header.propTypes = {
    /** Header text */
    title: PropTypes.string.isRequired
};

export default Header;