import React, { Component } from 'react';
import PropTypes from 'prop-types';

/** Radio button  */
class CheckBoxInput extends  Component {
    constructor(props) {
        super(props);

        this.classNames = {
            wrapperClass: '',
            alert: 'alert alert-danger',
        };

        this.css = {
            for: {
                container: {
                    marginBottom: '16px'
                },
                input: {
                    border: 'solid 1px red'
                },
                error: {
                    color: 'red'
                },
                checkbox: {
                    marginRight: '10px'
                }

            }
        };

    }

    componentDidMount () {
        if (this.props.indeterminate) {
            document.getElementById(this.props.name).indeterminate = true;
        }
    }

    render() {
        const css = this.css;
        const {name, label, dataType, value, onChange, style, isChecked, indeterminate} = this.props;
        return (
            <div className="form-check" style={style}>
                <label className="form-check-label" htmlFor={name}>
                    { isChecked ?
                        <input name={name} id={name} className="form-check-input" type="checkbox" style={css.for.checkbox} value={value} onChange={onChange} checked />
                        :
                        <input name={name} id={name} className="form-check-input" type="checkbox" style={css.for.checkbox} value={value} onChange={onChange} />
                    }

                    {label}
                </label>
            </div>
        );


    }

};

CheckBoxInput.propTypes = {
    /** Input name. Recommend setting this to match object's property so a single change handler can */
    name: PropTypes.string.isRequired,

    /** Input name. Recommend setting this to match object's property so a single change handler can */
    label: PropTypes.string.isRequired,

    /** Function to call onChange */
    onChange: PropTypes.func.isRequired,

    /** Value */
    value: PropTypes.string,

    isChecked: PropTypes.bool,

    indeterminate: PropTypes.bool
};

CheckBoxInput.defaultProps = {
    indeterminate: false
};

export default CheckBoxInput;