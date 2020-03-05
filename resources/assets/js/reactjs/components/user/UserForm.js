import React from 'react';
import PropTypes from 'prop-types';
import TextInput from '../TextInput';
import SelectInput from '../SelectInput';
import ContentForm from '../common/ContentForm';

/** function: MicrositeForm */
const UserForm = ({ errors }) => {
    // console.log('CourseForm', [course, allAuthors, onSave, onChange, saving, errors])
    return (
        <ContentForm>
            <h1>User Details</h1>
            { errors && errors.onSave && (
                <div className="alert alert-danger" role="alert">
                    {errors}
                </div>
            )}

            <TextInput
                name="userId"
                label="UserId"
                value=""
                error={errors && errors.userId}
            />

            <TextInput
                name="name"
                label="Name"
                value=""
                error={errors && errors.name}
            />

            [ <a href="/password">Change Password</a> ]

            <br />
            <br />


        </ContentForm>
    );
};

UserForm.propTypes = {
    /** myProp */
    //myProp: PropTypes.string.isRequired
};

UserForm.defaultProps = {
    //myProp: val
};

export default UserForm;