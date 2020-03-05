import React from 'react';
import PropTypes from 'prop-types';
import TextInput from '../TextInput';
import SelectInput from '../SelectInput';

/** function: CourseForm */
const CourseForm = ({course, allAuthors, onSave, onChange, saving, errors}) => {
    // console.log('CourseForm', [course, allAuthors, onSave, onChange, saving, errors])
    return (
        <form>
            <h1>Manage Course</h1>
            { errors && errors.onSave && (
                <div className="alert alert-danger" role="alert">
                    {errors}
                </div>
            )}

            <TextInput
                name="title"
                label="Title"
                value={course.title}
                onChange={onChange}
                error={errors && errors.title}
            />

            <SelectInput
                label="Author"
                name="authorId"
                value={course.authorId}
                defaultOption="Select Author"
                options={allAuthors}
                onChange={onChange}
                error={errors && errors.authorId}
            />

            <TextInput
                name="category"
                label="Category"
                value={course.category}
                onChange={onChange}
                error={errors && errors.category}
            />

            <TextInput
                name="length"
                label="Length"
                value={course.length}
                onChange={onChange}
                error={errors && errors.length}
            />

            <input
                type="submit"
                disabled={saving}
                value={saving ? 'Saving...' : 'Save'}
                className="btn btn-primary"
                onClick={onSave}
            />

        </form>
    );
};

CourseForm.propTypes = {
    /** course */
    course: PropTypes.object.isRequired,
    /** allAuthors */
    allAuthors: PropTypes.array.isRequired,
    /** onSave */
    onSave: PropTypes.func.isRequired,
    /** onChange */
    onChange: PropTypes.func.isRequired,
    /** loading */
    saving: PropTypes.bool,
    /** errors */
    errors: PropTypes.object
};

CourseForm.defaultProps = {
    //myProp: val
};

export default CourseForm;