import React from 'react';
import PropTypes from 'prop-types';
import TextInput from '../TextInput';
import ContentForm from '../common/ContentForm';

const AccountInfo = ({name, email, onChange, onClick, buttonCaption, buttonState}) => {

    return (
            <div className="row">
                <div className="col-md-6">

                    <ContentForm name="account-settings" className={"account-info"} onClick={onClick} onChange={onChange} buttonCaption={buttonCaption} buttonState={buttonState}>

                        <TextInput
                            name="name"
                            label="Name"
                            value={name}
                            onChange={onChange}
                        />
                        <br />
                        <TextInput
                            name="email"
                            label="Login Id"
                            value={email}
                            onChange={onChange}
                            disabled={true}
                        />

                        <br /><br />

                    </ContentForm>

                </div>

            </div>

    );
};

AccountInfo.propTypes = {
    /** myProp */
    name: PropTypes.string,
    email: PropTypes.string,
    onChange: PropTypes.func.isRequired,
    onClick: PropTypes.func.isRequired,
    buttonCaption: PropTypes.string.isRequired,
    buttonState: PropTypes.bool.isRequired
};

AccountInfo.defaultProps = {
    name: '',
    email: ''
};

export default AccountInfo;