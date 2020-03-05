import React from 'react';
import PropTypes from 'prop-types';
import Label from "../Label/Label";

/** Allows you to fill selects as a component without state */
const SelectInput = ({name, label, onChange, className, defaultOption, defaultValue, value, error, options, size}) =>  {

    let classNames = {
        wrapperClass: '',
        alert: 'alert alert-danger',
        select: 'form-control'
    };

    const css = {
        for: {
            select: {
                textAlign: 'center',
                display: 'block',
                width: '100%',
                height: 'calc(2.25rem + 2px)',
                padding: '.375rem .75rem',
                fontSize: '1rem',
                lineHeight: '1.5',
                color: '#495057',
                backgroundColor: '#fff',
                backgroundClip: 'paddingbox',
                border: '1px solid #ced4da',
                borderRadius: '.25rem',
                transition: 'bordercolor .15s easeinout,boxshadow .15s easeinout',
            },
            option: {}
        }
    };

    classNames.wrapperClass = error && error.length > 0 ? 'form-group has-error' : 'form-group';

    const select_options = options.map(option => {
        return <option key={option.value} value={option.value}>{option.text}</option>
    });

    return (
        <div className={"form-group"}>
            <Label htmlFor={name} label={label} required />
            <div className="field">
                {/* Note: value is set here rather than on the option - docs: https://facebook.git */}
                <select
                    name={name}
                    id={name}
                    size={size}
                    onChange={onChange}
                    style={css.for.select}
                    value={defaultValue} >
                    { select_options }
                </select>
                {error && <div className={classNames.alert} style={css.for.error}>{error}</div>}
            </div>
        </div>

    );
};

SelectInput.propTypes = {
    /** name */
    name: PropTypes.string.isRequired,

    /** label */
    label: PropTypes.string,

    /** onChange handler */
    onChange: PropTypes.func.isRequired,

    /** Default key to show */
    defaultOption: PropTypes.string,

    /** value */
    value: PropTypes.string,

    /** class name */
    className: PropTypes.string,

    /** error */
    error: PropTypes.string,

    /** Options data */
    options: PropTypes.arrayOf(PropTypes.object),

    /** Number of options to show at once */
    size: PropTypes.number
};

SelectInput.defaultProps = {
 size: 1
};

export default SelectInput;