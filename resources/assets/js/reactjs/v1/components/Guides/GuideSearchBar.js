import React, { Component } from 'react';
import { render } from 'react-dom';
import PropTypes from 'prop-types';
import toastr from 'toastr';

/** function: guidesearchBar */
class GuideSearchBar extends Component {
    constructor(props) {
        super(props);
        this.banner = '';
        this.eventArray = [];
        this.resultsContainer = '#guide-results';
        this.columns_available = 12;
        this.columns_to_show = 3;
        this.state = {
            showModal: false,
            guides: [],
            columns: this.columns_available / this.columns_to_show
        };

        this.token = jQuery('meta[name="csrf-token"]').attr('content');

        this.axios_instance = axios.create();
        delete this.axios_instance.defaults.headers.common['X-CSRF-TOKEN'];

        toastr.options = {
            "debug": false,
            "positionClass": "toast-bottom-right",
            "onclick": null,
            "fadeIn": 300,
            "fadeOut": 1000,
            "timeOut": 5000,
            "extendedTimeOut": 21000
        };

    }

    componentDidMount() {
        console.log('[Component Did Mount]', 'I mounted');
    }

    genGuides2(name, guides) {
        let tmp = guides.map( guide => {
            debugger;
            return <tr>
                        <td className="text-left">{ guide.name }</td>
                        <td className="text-left"><a href={ guide.url }>{ guide.guide_title.length ? guide.guide_title : guide.url }</a></td>
                    </tr>
        });

        return <div>
            <h4>{ name }</h4>
            <table className="table table-striped _fd3-table-responsive table-bordered table-hover my-3">
                <thead className="">
                    <th scope="col">Product</th>
                    <th scope="col">Guide</th>
                </thead>
                <tbody>
                { tmp }
                </tbody>
            </table>

        </div>
    }

    genGuides(name, guides) {
        let tmp = guides.map( guide => {
            return <li className="text-left"><a href={ guide.url }>{ guide.url }</a></li>
        });

        return <div>
                <h5>{ name }</h5>
                    <ul>
                        { tmp }
                    </ul>
               </div>
    }

    render() {
        const { loading } = this.state;
        if(loading) { // if your component doesn't have to wait for an async action, remove this block
            return null; // render null when app is not ready
        }

        let styles = {
            searchHeader: {
                "textAlign": "center"
            },
            responsiveThumbnail: {
                'maxWidth': '100%',
                'cursor': 'pointer'
            },
            clickContainer: {
                'cursor': 'pointer'
            },
            searchContainer: {
                'width': '100%',
                'margin': '10px auto',
                'textAlign': 'center',
              //  'marginLeft': '35px'
            }
        };

        return (
            <div>

                <div className="row">

                    <div className="col-md-3" />

                    <div className="col-md-6">

                        <div className="" style={styles.searchHeader}>
                            <h2 className="header main-section-header">Welcome to My Mobile Life Quoter Guides</h2>
                            <p className="header main-section-sub-header">Check out the guides below for answers to some of our most common support questions.</p>
                        </div>

                        <div className="lighter">
                            <div style={styles.searchContainer}>
                                <input type="text" className="search rounded" placeholder="Search by carrier" onChange={this.props.onChange} />
                                {/*<span className="end-of-input-icon"><i className="fa fa-search fa-fw" /></span>*/}
                            </div>
                        </div>

                    </div>

                    <div className="col-md-3" />

                </div>

                <div className="row">

                    <div className="col-md-12" >
                        <h4 className="text-center my-4">{ this.props.header }</h4>
                    </div>

                    {   this.props.guides.map( carrier => {
                        return <div className={"col-md-" + this.state.columns + " my-3"} >
                            <div className="card">
                                <div className="card-body">

                                    <div id="guides-search-container">
                                        <div>
                                            <h3 className="text-left my-4 heading-info">{ carrier.name }</h3>
                                                { carrier.categories.map( category => {
                                                    debugger;
                                                    return this.genGuides2(category.name, category.guides)
                                                })}
                                        </div>

                                    </div>

                                </div>
                            </div>
                        </div>
                    })}

                </div>
            </div>

        );
    }
}

GuideSearchBar.propTypes = {
    header: PropTypes.string,
    guides: PropTypes.array.isRequired,
};

GuideSearchBar.defaultProps = {
    header: '',
    guides: [],
};

export default GuideSearchBar;

if (document.getElementById('guide-search-bar')) {
    render(
        <GuideSearchBar />,
        document.getElementById('guide-search-bar')
    );
}