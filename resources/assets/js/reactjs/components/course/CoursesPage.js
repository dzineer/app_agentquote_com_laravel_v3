import React, {Component} from 'react';
import { connect } from 'react-redux';
import { bindActionCreators } from 'redux';
import * as courseActions from '../../actions/courseActions';
import PropTypes from 'prop-types';
import CourseList from './CourseList';

class CoursesPage extends Component {
    constructor(props) {
        super(props);
        this.state = {
            course: { title: '' },
            courses: []
        };
        this.redirectToCoursePage = this.redirectToCoursePage.bind(this);
    }

    redirectToCoursePage() {
        this.props.history.push('/course');
    };

    render() {
       // // debugger;
        const { courses } = this.props;
        return (
            <div>
                <h1 className="header text-center">Courses</h1>

                <input
                    type="submit"
                    value="Add Course"
                    className="btn btn-primary"
                    onClick={this.redirectToCoursePage} />

                <br /><br />

                <CourseList courses={courses} />
            </div>
        );
    }
}

CoursesPage.propTypes = {
    /** courses now actions array */
    courses: PropTypes.array.isRequired,

    /** action provides by injection from redux */
    actions: PropTypes.object.isRequired
};

const mapStateToProps = (state, ownProps) => {
    // // debugger;

    return {
        courses: state.courses, // <---- reducer method
    };
};

const mapDispatchToProps = (dispatch) => {
    return {
      //  createCourse: course => dispatch(courseAction.createCourse(course))
        // this will then inject actions into our PropTypes
        actions: bindActionCreators(courseActions, dispatch)
    }
};

export default connect(mapStateToProps, mapDispatchToProps)(CoursesPage);