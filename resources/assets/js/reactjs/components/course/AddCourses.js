import React, {Component} from 'react';
import { connect } from 'react-redux';
import { bindActionCreators } from 'redux';
import * as courseActions from '../../actions/courseActions';
import PropTypes from 'prop-types';

class CoursesPage extends Component {
    constructor(props) {
        super(props);
        this.state = {
            course: { title: '' },
            courses: []
        };
        this.onClickSave = this.onClickSave.bind(this);
    }

    onTitleChange = event => {
        const course = this.state.course;
        course.title = event.target.value;
        this.setState({course: course})
    };

    onChange = event => {
    };

    onClickSave(event) {
        /*this.props.dispatch(
            courseAction.createCourse(this.state.course)
        );*/

       // this.props.createCourse(this.state.course);
        this.props.actions.createCourse(this.state.course);

    };

    courseRow(course, index) {
        return <div key={index}>{course.title}</div>;
    };

    render() {
       // // debugger;
        return (
            <div>
                <h1>Courses</h1>
                {this.props.courses.map(this.courseRow)}
                <h2>Add Course</h2>

                <input
                    type="text"
                    onChange={this.onTitleChange}
                    value={this.state.course.title} />

                <input
                    type="submit"
                    value="Save"
                    onClick={this.onClickSave} />
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
        courses: state.courses // <---- reducer method
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