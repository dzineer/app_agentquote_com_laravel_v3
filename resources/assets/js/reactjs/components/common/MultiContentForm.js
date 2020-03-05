import React from 'react';
import PropTypes from 'prop-types';

/** function: MultiContentForm */
const MultiContentForm = ({name, children, onClick, buttonCaption, buttonState, ...props}) => {
    return (
        <form className={"form"}>

            <input
                type="submit"
                value={buttonCaption}
                className="btn btn-primary btn-block btn-lg py-16 mt-4" onClick={onClick} disabled={buttonState}
                enctype="multipart/form-data"
            />

            { children }

            <input
                type="submit"
                value={buttonCaption}
                className="btn btn-primary btn-block btn-lg py-16 mt-4" onClick={onClick} disabled={buttonState}
            />

        </form>
    );
};

MultiContentForm.propTypes = {
    name: PropTypes.string.isRequired,
    children: PropTypes.object,
    onSubmit: PropTypes.func,
    buttonCaption: PropTypes.string.isRequired,
    buttonState: PropTypes.bool.isRequired
};

MultiContentForm.propDefaults = {
    /** In case they user does not want to use onSubmit */
    onClick: () => {},
    buttonCaption: 'Save',
    buttonState: true
};

export default MultiContentForm;
