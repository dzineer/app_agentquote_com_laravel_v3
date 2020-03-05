import React from 'react';
import PropTypes from 'prop-types';
import FileField from "./FileField";

/** function: LogoField */
const LogoField = ({error, onChange}) => {
    return (
        <FileField label={"Logo"} name="logo" onChange={onChange} />
    );
};

LogoField.propTypes = {
    error: PropTypes.string
};

LogoField.defaultProps = {
    error: ""
};

export default LogoField;