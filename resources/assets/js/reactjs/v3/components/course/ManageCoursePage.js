import React, { Component } from 'react';
import PropTypes from 'prop-types';
import { connect } from 'react-redux';
import { bindActionCreators } from 'redux';
import { Redirect } from 'react-router-dom';
import * as courseActions from '../../actions/courseActions';
import CourseForm from "./CourseForm";
import toastr from 'toastr';

/** class ManageCoursePage */
class ManageCoursePage extends Component {
    constructor(props) {
        super(props);
        this.state = {
            course: Object.assign({}, props.course),
            errors: {},
            saving: false,
        };
        this.updateCourseState = this.updateCourseState.bind(this);
        this.saveCourse = this.saveCourse.bind(this);
    }

    componentWillReceiveProps(nextProps, nextContext) {
        if (this.props.course.id !== nextProps.course.id) {
            // Necessary to populate form when existing course is loaded directly.
            this.setState({course: Object.assign({}, nextProps.course)});
        }
    }

    updateCourseState(event) {
        //console.log(['this.state'], this.state);
        //console.log(['event'], event.target);
        //console.log(['event.value'], event.target.value);
        const field = event.target.name;
        let course = Object.assign({}, this.state.course);
        //console.log(['course'], course);
        course[field] = event.target.value;
        const newState = Object.assign({}, this.state, { course: course });
        return this.setState(newState);
    }

    saveCourse(event) {
        event.preventDefault();
        this.setState(
            Object.assign({}, this.state, {saving: true} )
        );

        this.props.actions.saveCourse(this.state.course)
            .then(() => {
                this.redirectToCoursesPage();
            }).catch(error => {
                toastr.error(error);
                this.setState(
                    Object.assign({}, this.state, {saving: false} )
                );
            });
    };

    redirectToCoursesPage() {
      //  Object.assign({}, this.state, { redirect: true });
      toastr.success('Course saved.')
      this.props.history.push('/courses');
    };

    render() {
        console.log('ManageCoursePage::Props', this.props);
        const { redirect } = this.state;
        return (
            redirect ? <Redirect to="/courses"/> :
            <CourseForm
                allAuthors={this.props.authors}
                onChange={this.updateCourseState}
                onSave={this.saveCourse}
                course={this.state.course}
                errors={this.state.errors}
                saving={this.state.saving}
            />
        );
    }
}

ManageCoursePage.propTypes = {
    /** course */
    course: PropTypes.object,

    /** authors */
    authors: PropTypes.array.isRequired,

    /** actions */
    actions: PropTypes.object.isRequired
};

ManageCoursePage.defaultProps = {
    //myProp: val
};

const getCourseById = (courses, id) => {
    const course =  courses.filter(course => course.id === id);
    // since filter return any array, have to grab the first item
    return course ? course[0] : null;
};

const mapStateToProps = (state, ownProps) => {
    const courseId = ownProps.match.params.id;
    let course = { id: '', watchHref: '', title: '', authorId: '', length: '', category: ''};
    if (courseId && state.courses.length > 0) {
        course = getCourseById(state.courses, courseId)
    }
    // // debugger;
    // console.log(['state.authors'], state.authors);
    const authorsFormattedForDropDown = state.authors.map(author => {
        console.log(['author'], author);
        return {
            value: author.id,
            text: author.firstName + ' ' + author.lastName
        };
    });

    return {
        course: course,
        authors: authorsFormattedForDropDown
    }
};

const mapDispatchToProps = dispatch => {
    // dispatch(beginAjaxCall());
    return {
        actions: bindActionCreators(courseActions, dispatch)
    };
};

export default connect(mapStateToProps, mapDispatchToProps)(ManageCoursePage);