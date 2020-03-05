import React from 'react';
import PropTypes from 'prop-types';
import TextInput from '../TextInput';
import SelectInput from '../SelectInput';
import FileField from "./FileField";

/** function: PortraitField */
const PortraitField = ({name, label, onChange, errors}) => {
    return (
        <FileField label={"Portrait"} name={"portrait"} onChange={onChange} />
    );
};

PortraitField.propTypes = {
    /** myProp */
    //myProp: PropTypes.string.isRequired
};

PortraitField.defaultProps = {
    //myProp: val
};

export default PortraitField;