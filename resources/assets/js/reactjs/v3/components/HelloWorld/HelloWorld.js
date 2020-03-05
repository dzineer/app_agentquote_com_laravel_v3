import React from 'react';
import PropTypes from 'prop-types';

function HelloWord({message}) {
    return (
        <h1>Hello {message}</h1>
    );
}

HelloWord.propTypes = {
    /**
     * Message to display  */
    message: PropTypes.string
};

HelloWord.defaultProps = {
    message: 'World'
};

export default HelloWord;