import React from 'react';
import PropTypes from 'prop-types';

/** function: ContentForm */
const ContentForm = ({name, children, onClick, buttonCaption, buttonState, ...props}) => {
    return (
        <form className={"form"}>

            <input
                type="submit"
                value={buttonCaption}
                className="btn btn-primary btn-block btn-lg py-16 mt-4" onClick={onClick} disabled={buttonState}
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

ContentForm.propTypes = {
    name: PropTypes.string.isRequired,
    children: PropTypes.object,
    onSubmit: PropTypes.func,
    buttonCaption: PropTypes.string.isRequired,
    buttonState: PropTypes.bool.isRequired
};

ContentForm.propDefaults = {
    /** In case they user does not want to use onSubmit */
    onClick: () => {},
    buttonCaption: 'Save',
    buttonState: true
};

export default ContentForm;
