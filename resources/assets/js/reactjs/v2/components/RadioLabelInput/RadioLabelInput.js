import React from 'react';
import PropTypes from 'prop-types';
import RadioInput from '../RadioInput';
import Label from '../Label';

/** Radio button  */
const RadioLabelInput = ({htmlId, name, containerClassName, radioClassName, labelClassName, label, value, selected, radioInside, required, ...props}) => {
    const css = {
        for: {
            input: {
                marginRight: '6px'
            }
        }
    };

    return (
        radioInside ?
            <div className={containerClassName}>
                <Label htmlFor={htmlId} label={label} labelClassName={labelClassName} required={required}>
                    <RadioInput
                        id={htmlId}
                        style={css.for.input}
                        className={radioClassName}
                        name={name}
                        value={value}
                        selected={selected}
                        {...props}
                    />

                </Label>
            </div>
            :
            <div className={containerClassName}>
                <RadioInput
                    id={htmlId}
                    style={css.for.input}
                    className={radioClassName}
                    type="radio"
                    name={name}
                    value={value}
                    selected={selected}
                    {...props}
                />
                <label htmlFor={htmlId}>{label}</label>
            </div>
    );
};

RadioLabelInput.propTypes = {
    /** Unique HTML ID. Used for tying label to HTML input. Handy hook for automated testing.  */
    htmlId: PropTypes.string.isRequired,

    /** Input name. Recommend setting this to match object's property so a single change handler can */
    name: PropTypes.string.isRequired,

    /** Input label  */
    label: PropTypes.string.isRequired,

    /** Function to call onChange */
    onChange: PropTypes.func.isRequired,

    /** Container Class for css styling */
    containerClassName: PropTypes.string,

    /** label Class for css styling */
    labelClassName: PropTypes.string,

    /** CheckBoxInput Class for css styling */
    radioClassName: PropTypes.string,

    /** Choose if the radio button should be nested inside a label **/
    radioInside: PropTypes.bool,

    /** is this radio selected */
    selected: PropTypes.bool,

    /** Value */
    value: PropTypes.string.isRequired,

    /** Required */
    required: PropTypes.bool,
};

RadioLabelInput.propTypes = {
    radioInside: true
};

export default RadioLabelInput;