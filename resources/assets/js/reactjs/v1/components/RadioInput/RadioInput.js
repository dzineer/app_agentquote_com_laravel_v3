import React from 'react';
import PropTypes from 'prop-types';

/** Radio button  */
const RadioInput = ({htmlId, radioName, className, styles, onChange, value, selected, ...props}) => {
    return (
            <input
                type="radio"
                name={radioName}
                className={className}
                id={htmlId}
                style={styles}
                value={value}
                onChange={onChange}
                {...props}
            />
    );
};

RadioInput.propTypes = {
    /** Unique HTML ID. Used for tying label to HTML input. Handy hook for automated testing.  */
    htmlId: PropTypes.string.isRequired,

    /** Input name. Recommend setting this to match object's property so a single change handler can */
    radioName: PropTypes.string.isRequired,

    /** Function to call onChange */
    onChange: PropTypes.func.isRequired,

    /** Container Class for css styling */
    className: PropTypes.string,

    /** css styling */
    styles: PropTypes.string,

    /** Value */
    value: PropTypes.string.isRequired,
};

RadioInput.propTypes = {
};

export default RadioInput;