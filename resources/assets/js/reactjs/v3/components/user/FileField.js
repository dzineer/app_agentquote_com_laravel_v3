import React from 'react';
import PropTypes from 'prop-types';

/** function: FileField */
const FileField = ({ name, label, value, onChange, error }) => {
    const css = {
        for: {
            fileInput: {
                display: "inline-block"
            },
            portrait: {
                display: "block"
            }
        }
    };

    return (
        <div className="form-group">
            <div className="field">
                { error && (
                    <div className="alert alert-danger" role="alert">
                        {error}
                    </div>
                )}
                <label htmlFor={name} style={css.for.portrait}>{label}</label>
                <input id={name} name={name} type="file" className="form-control-file" style={css.for.fileInput} onChange={onChange} />
                { value && <a href="">[ remove ]</a> }
            </div>
        </div>
    );
};

FileField.propTypes = {
    /** myProp */
    name: PropTypes.string.isRequired,
    label: PropTypes.string.isRequired,
    value: PropTypes.string
};

FileField.defaultProps = {
};

export default FileField;