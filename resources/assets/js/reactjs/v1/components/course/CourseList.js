import React from 'react';
import PropTypes from 'prop-types';
import CourseListRow from './CourseListRow';
const CourseList = ({courses}) => {
   const css = {
     for: {
         table: {
             marginTop: '10px'
         }
     }
   };
   return (
       <table className="table" style={css.for.table}>
           <thead>
                <tr>
                    <th>&nbsp;</th>
                    <th>Title</th>
                    <th>Author</th>
                    <th>Category</th>
                    <th>Length</th>
                </tr>
           </thead>
           <tbody>
           {
               courses.map(course => {
                   return <CourseListRow key={course.id} course={course} />
               })
           }
           </tbody>
       </table>
    );
};

CourseList.protoTypes = {
    courses: PropTypes.array.isRequired
};

export default CourseList;