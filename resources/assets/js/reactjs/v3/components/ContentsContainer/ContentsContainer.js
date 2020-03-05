import React, {Component} from 'react';
import PropTypes from 'prop-types';

/** class ContentsContainer */
class ContentsContainer extends Component {
    constructor(props) {
        super(props);
        this.state = {};
    }

    render() {
        return (
            <div className="contents_container">
                <div className="contents">
                    <div className="links_container">
                        <a className="manage_apps_link" data-manage_apps_link="" href="/apps/manage">Manage apps...</a>
                        <a className="view_tutorial_link display_none" data-view_tutorial_link="">What are apps?</a>
                    </div>
                    <div data-reactroot="" id="apps_browser_container">
                        <div className="p-apps_browser">
                            <div className="p-apps_browser__filter_container">
                                <div className="p-apps_browser__filter_header">
                                    <h2>Browse Apps</h2>
                                    <button
                                        className="c-button c-button--outline c-button--large p-apps_browser__browse_apps null--outline null--large"
                                        type="button">View App Directory
                                    </button>
                                </div>
                                <div>
                                    <div className="c-filter_input" role="presentation">
                                        <i aria-hidden="true" className="c-icon nudge_top_1 c-icon--search-medium"
                                           type="search_medium" /><input className="c-filter_input__input mousetrap"
                                                                           placeholder="Search by name or category (e.g. productivity, sales)"
                                                                           type="text" value="">
                                        <div className="c-filter_input__right_icons">
                                            <i aria-hidden="true"
                                               className="c-icon c-filter_input__reset_button padding_right_25 c-icon--close-filled c-icon--inherit"
                                               type="close-filled" />
                                            <div className="c-filter_input__loading_indicator">
                                                <div
                                                    className="c-infinite_spinner c-infinite_spinner--medium c-infinite_spinner--fast c-infinite_spinner--blue">
                                                    <svg className="c-infinite_spinner__spinner" viewBox="0 0 100 100">
                                                        <circle className="c-infinite_spinner__bg" cx="50%" cy="50%"
                                                                r="35" />
                                                        <circle className="c-infinite_spinner__path" cx="50%" cy="50%"
                                                                r="35" />
                                                    </svg>
                                                    <svg
                                                        className="c-infinite_spinner__spinner c-infinite_spinner__tail"
                                                        viewBox="0 0 100 100">
                                                        <circle className="c-infinite_spinner__path" cx="50%" cy="50%"
                                                                r="35" />
                                                    </svg>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div className="p-apps_browser__apps_list" data-apps_list="true">
                                <section
                                    className="p-apps_browser__category_section p-apps_browser__category_section--tutorial">
                                    <div className="p-apps_browser__category_header" data-category_header="true"></div>
                                    <div className="p-apps_browser__app" data-app="true" data-app_id="tutorial_app"
                                         data-app_index="0" data-bot_id="" data-bot_user_id="" data-is_installed="false"
                                         role="presentation">
                                        <img alt="App icon" className="p-apps_browser__app_icon"
                                             src="https://a.slack-edge.com/436da/img/tutorial@2x.png" />
                                            <div className="p-apps_browser__app_info">
                                                <div className="p-apps_browser__app_name">
                                                    <strong>What are apps?</strong>
                                                </div>
                                                <div className="p-apps_browser__app_description">
                                                    A quick look at how apps in Slack can streamline your work
                                                </div>
                                            </div>
                                            <button
                                                className="c-button c-button--outline c-button--medium p-apps_browser__app_action null--outline null--medium"
                                                type="button">Start
                                            </button>
                                    </div>
                                </section>
                                <section className="p-apps_browser__category_section">
                                    <div className="p-apps_browser__category_header" data-category_header="true">
                                        Add apps to your workspace
                                    </div>
                                    <div className="p-apps_browser__app" data-app="true" data-app_id="A0F827J2C"
                                         data-app_index="1" data-bot_id="" data-bot_user_id="" data-is_installed="false"
                                         role="presentation">
                                        <img alt="App icon" className="p-apps_browser__app_icon"
                                             src="https://a.slack-edge.com/7f1a0/plugins/giphy/assets/service_72.png" />
                                            <div className="p-apps_browser__app_info">
                                                <div className="p-apps_browser__app_name">
                                                    <strong>Giphy</strong>
                                                </div>
                                                <div className="p-apps_browser__app_description">
                                                    An online library of animated GIFs
                                                </div>
                                            </div>
                                            <button
                                                className="c-button c-button--outline c-button--medium p-apps_browser__app_action null--outline null--medium"
                                                type="button">Install
                                            </button>
                                    </div>
                                    <div className="p-apps_browser__app" data-app="true" data-app_id="A6NL8MJ6Q"
                                         data-app_index="2" data-bot_id="" data-bot_user_id="" data-is_installed="false"
                                         role="presentation">
                                        <img alt="App icon" className="p-apps_browser__app_icon"
                                             src="https://slack-files2.s3-us-west-2.amazonaws.com/avatars/2017-08-28/232381175025_31793c43d684e5a7c75a_72.png" />
                                            <div className="p-apps_browser__app_info">
                                                <div className="p-apps_browser__app_name">
                                                    <strong>Google Drive</strong>
                                                </div>
                                                <div className="p-apps_browser__app_description">
                                                    Get notifications about Google Drive files within Slack
                                                </div>
                                            </div>
                                            <button
                                                className="c-button c-button--outline c-button--medium p-apps_browser__app_action null--outline null--medium"
                                                type="button">Install
                                            </button>
                                    </div>
                                    <div className="p-apps_browser__app" data-app="true" data-app_id="A074YH40Z"
                                         data-app_index="3" data-bot_id="" data-bot_user_id="" data-is_installed="false"
                                         role="presentation">
                                        <img alt="App icon" className="p-apps_browser__app_icon"
                                             src="https://slack-files2.s3-us-west-2.amazonaws.com/avatars/2016-05-18/44042585718_0e6a837d5b63fd1cfc07_72.png" />
                                            <div className="p-apps_browser__app_info">
                                                <div className="p-apps_browser__app_name">
                                                    <strong>Trello</strong>
                                                </div>
                                                <div className="p-apps_browser__app_description">
                                                    Collaborate on Trello projects without leaving Slack.
                                                </div>
                                            </div>
                                            <button
                                                className="c-button c-button--outline c-button--medium p-apps_browser__app_action null--outline null--medium"
                                                type="button">Install
                                            </button>
                                    </div>
                                    <div className="p-apps_browser__app" data-app="true" data-app_id="A0F82E5R8"
                                         data-app_index="4" data-bot_id="" data-bot_user_id="" data-is_installed="false"
                                         role="presentation">
                                        <img alt="App icon" className="p-apps_browser__app_icon"
                                             src="https://a.slack-edge.com/ca1d0/img/services/dropbox_72.png" />
                                            <div className="p-apps_browser__app_info">
                                                <div className="p-apps_browser__app_name">
                                                    <strong>Dropbox</strong>
                                                </div>
                                                <div className="p-apps_browser__app_description">
                                                    Cloud file storage and syncing
                                                </div>
                                            </div>
                                            <button
                                                className="c-button c-button--outline c-button--medium p-apps_browser__app_action null--outline null--medium"
                                                type="button">Install
                                            </button>
                                    </div>
                                    <div className="p-apps_browser__app" data-app="true" data-app_id="A0F7XDW93"
                                         data-app_index="5" data-bot_id="" data-bot_user_id="" data-is_installed="false"
                                         role="presentation">
                                        <img alt="App icon" className="p-apps_browser__app_icon"
                                             src="https://a.slack-edge.com/205a/img/services/twitter_72.png" />
                                            <div className="p-apps_browser__app_info">
                                                <div className="p-apps_browser__app_name">
                                                    <strong>Twitter</strong>
                                                </div>
                                                <div className="p-apps_browser__app_description">
                                                    Bring tweets into Slack.
                                                </div>
                                            </div>
                                            <button
                                                className="c-button c-button--outline c-button--medium p-apps_browser__app_action null--outline null--medium"
                                                type="button">Install
                                            </button>
                                    </div>
                                    <div className="p-apps_browser__app" data-app="true" data-app_id="A0HFW7MR6"
                                         data-app_index="6" data-bot_id="" data-bot_user_id="" data-is_installed="false"
                                         role="presentation">
                                        <img alt="App icon" className="p-apps_browser__app_icon"
                                             src="https://slack-files2.s3-us-west-2.amazonaws.com/avatars/2016-01-03/17670668547_3b5cda05986fc6c0d978_72.png" />
                                            <div className="p-apps_browser__app_info">
                                                <div className="p-apps_browser__app_name">
                                                    <strong>Simple Poll</strong>
                                                </div>
                                                <div className="p-apps_browser__app_description">
                                                    Create native and simple polls in Slack.
                                                </div>
                                            </div>
                                            <button
                                                className="c-button c-button--outline c-button--medium p-apps_browser__app_action null--outline null--medium"
                                                type="button">Install
                                            </button>
                                    </div>
                                    <div className="p-apps_browser__app" data-app="true" data-app_id="A0F8149ED"
                                         data-app_index="7" data-bot_id="" data-bot_user_id="" data-is_installed="false"
                                         role="presentation">
                                        <img alt="App icon" className="p-apps_browser__app_icon"
                                             src="https://a.slack-edge.com/7f1a0/plugins/gcalendar/assets/service_72.png" />
                                            <div className="p-apps_browser__app_info">
                                                <div className="p-apps_browser__app_name">
                                                    <strong>Google Calendar</strong>
                                                </div>
                                                <div className="p-apps_browser__app_description">
                                                    A shared calendar for your team.
                                                </div>
                                            </div>
                                            <button
                                                className="c-button c-button--outline c-button--medium p-apps_browser__app_action null--outline null--medium"
                                                type="button">Install
                                            </button>
                                    </div>
                                    <div className="p-apps_browser__app" data-app="true" data-app_id="A0F7YS351"
                                         data-app_index="8" data-bot_id="" data-bot_user_id="" data-is_installed="false"
                                         role="presentation">
                                        <img alt="App icon" className="p-apps_browser__app_icon"
                                             src="https://a.slack-edge.com/205a/img/services/hangouts_72.png" />
                                            <div className="p-apps_browser__app_info">
                                                <div className="p-apps_browser__app_name">
                                                    <strong>Google+ Hangouts</strong>
                                                </div>
                                                <div className="p-apps_browser__app_description">
                                                    Bring your conversations to life with free video calls.
                                                </div>
                                            </div>
                                            <button
                                                className="c-button c-button--outline c-button--medium p-apps_browser__app_action null--outline null--medium"
                                                type="button">Install
                                            </button>
                                    </div>
                                    <div className="p-apps_browser__app" data-app="true" data-app_id="A0HBTUUPK"
                                         data-app_index="9" data-bot_id="" data-bot_user_id="" data-is_installed="false"
                                         role="presentation">
                                        <img alt="App icon" className="p-apps_browser__app_icon"
                                             src="https://slack-files2.s3-us-west-2.amazonaws.com/avatars/2017-01-22/130976277813_a8ab564623726e14ea32_72.png" />
                                            <div className="p-apps_browser__app_info">
                                                <div className="p-apps_browser__app_name">
                                                    <strong>To-do</strong>
                                                </div>
                                                <div className="p-apps_browser__app_description">
                                                    Simple and powerful to-do list and task manager by Workast
                                                </div>
                                            </div>
                                            <button
                                                className="c-button c-button--outline c-button--medium p-apps_browser__app_action null--outline null--medium"
                                                type="button">Install
                                            </button>
                                    </div>
                                    <div className="p-apps_browser__app" data-app="true" data-app_id="A028LGAFF"
                                         data-app_index="10" data-bot_id="" data-bot_user_id=""
                                         data-is_installed="false" role="presentation">
                                        <img alt="App icon" className="p-apps_browser__app_icon"
                                             src="https://slack-files2.s3-us-west-2.amazonaws.com/avatars/2016-11-04/101273840518_6a9119a0601c8509247c_72.png" />
                                            <div className="p-apps_browser__app_info">
                                                <div className="p-apps_browser__app_name">
                                                    <strong>IFTTT</strong>
                                                </div>
                                                <div className="p-apps_browser__app_description">
                                                    Automated connections between web services.
                                                </div>
                                            </div>
                                            <button
                                                className="c-button c-button--outline c-button--medium p-apps_browser__app_action null--outline null--medium"
                                                type="button">Install
                                            </button>
                                    </div>
                                    <div className="p-apps_browser__app" data-app="true" data-app_id="A024R9PQM"
                                         data-app_index="11" data-bot_id="" data-bot_user_id=""
                                         data-is_installed="false" role="presentation">
                                        <img alt="App icon" className="p-apps_browser__app_icon"
                                             src="https://slack-files2.s3-us-west-2.amazonaws.com/avatars/2017-06-20/200850512066_2d5e268a3b71c87f969c_72.png" />
                                            <div className="p-apps_browser__app_info">
                                                <div className="p-apps_browser__app_name">
                                                    <strong>Zapier</strong>
                                                </div>
                                                <div className="p-apps_browser__app_description">
                                                    Easy automation for busy people
                                                </div>
                                            </div>
                                            <button
                                                className="c-button c-button--outline c-button--medium p-apps_browser__app_action null--outline null--medium"
                                                type="button">Install
                                            </button>
                                    </div>
                                    <div className="p-apps_browser__app" data-app="true" data-app_id="A0F81R7U7"
                                         data-app_index="12" data-bot_id="" data-bot_user_id=""
                                         data-is_installed="false" role="presentation">
                                        <img alt="App icon" className="p-apps_browser__app_icon"
                                             src="https://a.slack-edge.com/205a/img/services/rss_72.png" />
                                            <div className="p-apps_browser__app_info">
                                                <div className="p-apps_browser__app_name">
                                                    <strong>RSS</strong>
                                                </div>
                                                <div className="p-apps_browser__app_description">
                                                    Automatically syndicated site content.
                                                </div>
                                            </div>
                                            <button
                                                className="c-button c-button--outline c-button--medium p-apps_browser__app_action null--outline null--medium"
                                                type="button">Install
                                            </button>
                                    </div>
                                    <div className="p-apps_browser__app" data-app="true" data-app_id="A04E6JX41"
                                         data-app_index="13" data-bot_id="" data-bot_user_id=""
                                         data-is_installed="false" role="presentation">
                                        <img alt="App icon" className="p-apps_browser__app_icon"
                                             src="https://slack-files2.s3-us-west-2.amazonaws.com/avatars/2016-05-09/41532123248_86c89d7c608b75bbd782_72.png" />
                                            <div className="p-apps_browser__app_info">
                                                <div className="p-apps_browser__app_name">
                                                    <strong>Polly</strong>
                                                </div>
                                                <div className="p-apps_browser__app_description">
                                                    Polls and surveys in Slack 📊
                                                </div>
                                            </div>
                                            <button
                                                className="c-button c-button--outline c-button--medium p-apps_browser__app_action null--outline null--medium"
                                                type="button">Install
                                            </button>
                                    </div>
                                    <div className="p-apps_browser__app" data-app="true" data-app_id="A53TM6XA9"
                                         data-app_index="14" data-bot_id="" data-bot_user_id=""
                                         data-is_installed="false" role="presentation">
                                        <img alt="App icon" className="p-apps_browser__app_icon"
                                             src="https://a.slack-edge.com/7f1a0/plugins/onedrive/assets/service_72.png" />
                                            <div className="p-apps_browser__app_info">
                                                <div className="p-apps_browser__app_name">
                                                    <strong>Microsoft OneDrive</strong>
                                                </div>
                                                <div className="p-apps_browser__app_description">
                                                    Quick access to your files from all your devices
                                                </div>
                                            </div>
                                            <button
                                                className="c-button c-button--outline c-button--medium p-apps_browser__app_action null--outline null--medium"
                                                type="button">Install
                                            </button>
                                    </div>
                                    <div className="p-apps_browser__app" data-app="true" data-app_id="A8GBNUWU8"
                                         data-app_index="15" data-bot_id="" data-bot_user_id=""
                                         data-is_installed="false" role="presentation">
                                        <img alt="App icon" className="p-apps_browser__app_icon"
                                             src="https://slack-files2.s3-us-west-2.amazonaws.com/avatars/2017-12-19/288981919427_f45f04edd92902a96859_72.png" />
                                            <div className="p-apps_browser__app_info">
                                                <div className="p-apps_browser__app_name">
                                                    <strong>GitHub</strong>
                                                </div>
                                                <div className="p-apps_browser__app_description">
                                                    Get updates from the world’s leading development platform on Slack
                                                </div>
                                            </div>
                                            <button
                                                className="c-button c-button--outline c-button--medium p-apps_browser__app_action null--outline null--medium"
                                                type="button">Install
                                            </button>
                                    </div>
                                    <div className="p-apps_browser__app" data-app="true" data-app_id="AA16LBCH2"
                                         data-app_index="16" data-bot_id="" data-bot_user_id=""
                                         data-is_installed="false" role="presentation">
                                        <img alt="App icon" className="p-apps_browser__app_icon"
                                             src="https://slack-files2.s3-us-west-2.amazonaws.com/avatars/2018-04-04/341591994389_f9b34fbf501c8b52203d_72.png" />
                                            <div className="p-apps_browser__app_info">
                                                <div className="p-apps_browser__app_name">
                                                    <strong>Asana</strong>
                                                </div>
                                                <div className="p-apps_browser__app_description">
                                                    Move work forward.
                                                </div>
                                            </div>
                                            <button
                                                className="c-button c-button--outline c-button--medium p-apps_browser__app_action null--outline null--medium"
                                                type="button">Install
                                            </button>
                                    </div>
                                    <div className="p-apps_browser__app" data-app="true" data-app_id="A2RPP3NFR"
                                         data-app_index="17" data-bot_id="" data-bot_user_id=""
                                         data-is_installed="false" role="presentation">
                                        <img alt="App icon" className="p-apps_browser__app_icon"
                                             src="https://slack-files2.s3-us-west-2.amazonaws.com/avatars/2017-09-11/239622728805_193a5464df40bdbdb528_72.png" />
                                            <div className="p-apps_browser__app_info">
                                                <div className="p-apps_browser__app_name">
                                                    <strong>Jira Cloud</strong>
                                                </div>
                                                <div className="p-apps_browser__app_description">
                                                    Easily connect Jira Cloud projects to your Slack channels
                                                </div>
                                            </div>
                                            <button
                                                className="c-button c-button--outline c-button--medium p-apps_browser__app_action null--outline null--medium"
                                                type="button">Install
                                            </button>
                                    </div>
                                    <div className="p-apps_browser__app" data-app="true" data-app_id="A0FLZ2GVB"
                                         data-app_index="18" data-bot_id="" data-bot_user_id=""
                                         data-is_installed="false" role="presentation">
                                        <img alt="App icon" className="p-apps_browser__app_icon"
                                             src="https://slack-files2.s3-us-west-2.amazonaws.com/avatars/2015-12-15/16747233735_cd6d563053f8079cd36f_72.png" />
                                            <div className="p-apps_browser__app_info">
                                                <div className="p-apps_browser__app_name">
                                                    <strong>Gif Keyboard</strong>
                                                </div>
                                                <div className="p-apps_browser__app_description">
                                                    Choose and share the perfect GIF. Caption your favorites.
                                                </div>
                                            </div>
                                            <button
                                                className="c-button c-button--outline c-button--medium p-apps_browser__app_action null--outline null--medium"
                                                type="button">Install
                                            </button>
                                    </div>
                                    <div className="p-apps_browser__app" data-app="true" data-app_id="A0F7XDU93"
                                         data-app_index="19" data-bot_id="" data-bot_user_id=""
                                         data-is_installed="false" role="presentation">
                                        <img alt="App icon" className="p-apps_browser__app_icon"
                                             src="https://a.slack-edge.com/7f1a0/plugins/hubot/assets/service_72.png" />
                                            <div className="p-apps_browser__app_info">
                                                <div className="p-apps_browser__app_name">
                                                    <strong>Hubot</strong>
                                                </div>
                                                <div className="p-apps_browser__app_description">
                                                    GitHub's scriptable chat bot.
                                                </div>
                                            </div>
                                            <button
                                                className="c-button c-button--outline c-button--medium p-apps_browser__app_action null--outline null--medium"
                                                type="button">Install
                                            </button>
                                    </div>
                                    <div className="p-apps_browser__app" data-app="true" data-app_id="A0F82E57C"
                                         data-app_index="20" data-bot_id="" data-bot_user_id=""
                                         data-is_installed="false" role="presentation">
                                        <img alt="App icon" className="p-apps_browser__app_icon"
                                             src="https://a.slack-edge.com/7f1a0/plugins/box/assets/service_72.png" />
                                            <div className="p-apps_browser__app_info">
                                                <div className="p-apps_browser__app_name">
                                                    <strong>Box</strong>
                                                </div>
                                                <div className="p-apps_browser__app_description">
                                                    Securely store, share, and manage all your files
                                                </div>
                                            </div>
                                            <button
                                                className="c-button c-button--outline c-button--medium p-apps_browser__app_action null--outline null--medium"
                                                type="button">Install
                                            </button>
                                    </div>
                                    <div className="p-apps_browser__app" data-app="true" data-app_id="A0EP69E58"
                                         data-app_index="21" data-bot_id="" data-bot_user_id=""
                                         data-is_installed="false" role="presentation">
                                        <img alt="App icon" className="p-apps_browser__app_icon"
                                             src="https://slack-files2.s3-us-west-2.amazonaws.com/avatars/2016-04-06/32656022455_3f51bd50630a4ea2a08b_72.png" />
                                            <div className="p-apps_browser__app_info">
                                                <div className="p-apps_browser__app_name">
                                                    <strong>Kyber</strong>
                                                </div>
                                                <div className="p-apps_browser__app_description">
                                                    All-in-one task &amp; project management, todo lists, polls and
                                                    calendars inside Slack
                                                </div>
                                            </div>
                                            <button
                                                className="c-button c-button--outline c-button--medium p-apps_browser__app_action null--outline null--medium"
                                                type="button">Install
                                            </button>
                                    </div>
                                    <div className="p-apps_browser__app" data-app="true" data-app_id="A0S35UGTC"
                                         data-app_index="22" data-bot_id="" data-bot_user_id=""
                                         data-is_installed="false" role="presentation">
                                        <img alt="App icon" className="p-apps_browser__app_icon"
                                             src="https://slack-files2.s3-us-west-2.amazonaws.com/avatars/2018-05-10/361581500802_805517e7bd209d4189d4_72.png" />
                                            <div className="p-apps_browser__app_info">
                                                <div className="p-apps_browser__app_name">
                                                    <strong>Teamline</strong>
                                                </div>
                                                <div className="p-apps_browser__app_description">
                                                    🚩 The simple project management tool for Slack
                                                </div>
                                            </div>
                                            <button
                                                className="c-button c-button--outline c-button--medium p-apps_browser__app_action null--outline null--medium"
                                                type="button">Install
                                            </button>
                                    </div>
                                    <div className="p-apps_browser__app" data-app="true" data-app_id="A8W8QLZD1"
                                         data-app_index="23" data-bot_id="" data-bot_user_id=""
                                         data-is_installed="false" role="presentation">
                                        <img alt="App icon" className="p-apps_browser__app_icon"
                                             src="https://slack-files2.s3-us-west-2.amazonaws.com/avatars/2018-03-21/334235045829_1d1db85d6877560365df_72.png" />
                                            <div className="p-apps_browser__app_info">
                                                <div className="p-apps_browser__app_name">
                                                    <strong>Bitbucket Cloud</strong>
                                                </div>
                                                <div className="p-apps_browser__app_description">
                                                    Get updates about your Bitbucket repositories and take action in
                                                    Slack
                                                </div>
                                            </div>
                                            <button
                                                className="c-button c-button--outline c-button--medium p-apps_browser__app_action null--outline null--medium"
                                                type="button">Install
                                            </button>
                                    </div>
                                    <div className="p-apps_browser__app" data-app="true" data-app_id="A08N434LS"
                                         data-app_index="24" data-bot_id="" data-bot_user_id=""
                                         data-is_installed="false" role="presentation">
                                        <img alt="App icon" className="p-apps_browser__app_icon"
                                             src="https://slack-files2.s3-us-west-2.amazonaws.com/avatars/2017-03-27/159746031889_77753ab40a2fa603bd53_72.png" />
                                            <div className="p-apps_browser__app_info">
                                                <div className="p-apps_browser__app_name">
                                                    <strong>InVision App</strong>
                                                </div>
                                                <div className="p-apps_browser__app_description">
                                                    Streamline your design workflow by bringing the feedback process
                                                    right into Slack.
                                                </div>
                                            </div>
                                            <button
                                                className="c-button c-button--outline c-button--medium p-apps_browser__app_action null--outline null--medium"
                                                type="button">Install
                                            </button>
                                    </div>
                                    <div className="p-apps_browser__app" data-app="true" data-app_id="A2DAS7NNR"
                                         data-app_index="25" data-bot_id="" data-bot_user_id=""
                                         data-is_installed="false" role="presentation">
                                        <img alt="App icon" className="p-apps_browser__app_icon"
                                             src="https://a.slack-edge.com/7f1a0/plugins/salesforce/assets/service_72.png" />
                                            <div className="p-apps_browser__app_info">
                                                <div className="p-apps_browser__app_name">
                                                    <strong>Salesforce</strong>
                                                </div>
                                                <div className="p-apps_browser__app_description">
                                                    Search and view information from Salesforce in Slack.
                                                </div>
                                            </div>
                                            <button
                                                className="c-button c-button--outline c-button--medium p-apps_browser__app_action null--outline null--medium"
                                                type="button">Install
                                            </button>
                                    </div>
                                    <div className="p-apps_browser__app" data-app="true" data-app_id="A0G51AT60"
                                         data-app_index="26" data-bot_id="" data-bot_user_id=""
                                         data-is_installed="false" role="presentation">
                                        <img alt="App icon" className="p-apps_browser__app_icon"
                                             src="https://slack-files2.s3-us-west-2.amazonaws.com/avatars/2017-02-21/144221668546_9c44dbfe73488d4b8d5e_72.png" />
                                            <div className="p-apps_browser__app_info">
                                                <div className="p-apps_browser__app_name">
                                                    <strong>Meekan Scheduling</strong>
                                                </div>
                                                <div className="p-apps_browser__app_description">
                                                    Schedule meetings, find a room, get reminders, manage calendars
                                                </div>
                                            </div>
                                            <button
                                                className="c-button c-button--outline c-button--medium p-apps_browser__app_action null--outline null--medium"
                                                type="button">Install
                                            </button>
                                    </div>
                                    <div className="p-apps_browser__app" data-app="true" data-app_id="A5P5FDK33"
                                         data-app_index="27" data-bot_id="" data-bot_user_id=""
                                         data-is_installed="false" role="presentation">
                                        <img alt="App icon" className="p-apps_browser__app_icon"
                                             src="https://slack-files2.s3-us-west-2.amazonaws.com/avatars/2018-06-17/384053245894_495b0d8bc7454e59a3c8_72.png" />
                                            <div className="p-apps_browser__app_info">
                                                <div className="p-apps_browser__app_name">
                                                    <strong>Cisco Webex Meetings</strong>
                                                </div>
                                                <div className="p-apps_browser__app_description">
                                                    Start or join Webex video meetings from Slack.
                                                </div>
                                            </div>
                                            <button
                                                className="c-button c-button--outline c-button--medium p-apps_browser__app_action null--outline null--medium"
                                                type="button">Install
                                            </button>
                                    </div>
                                    <div className="p-apps_browser__app" data-app="true" data-app_id="A5GE9BMQC"
                                         data-app_index="28" data-bot_id="" data-bot_user_id=""
                                         data-is_installed="false" role="presentation">
                                        <img alt="App icon" className="p-apps_browser__app_icon"
                                             src="https://slack-files2.s3-us-west-2.amazonaws.com/avatars/2017-06-01/190948878097_9e7d7dc1d1135e8e6885_72.png" />
                                            <div className="p-apps_browser__app_info">
                                                <div className="p-apps_browser__app_name">
                                                    <strong>Zoom</strong>
                                                </div>
                                                <div className="p-apps_browser__app_description">
                                                    Easily start a Zoom video meeting directly from Slack.
                                                </div>
                                            </div>
                                            <button
                                                className="c-button c-button--outline c-button--medium p-apps_browser__app_action null--outline null--medium"
                                                type="button">Install
                                            </button>
                                    </div>
                                    <div className="p-apps_browser__app" data-app="true" data-app_id="A0DV3EEN4"
                                         data-app_index="29" data-bot_id="" data-bot_user_id=""
                                         data-is_installed="false" role="presentation">
                                        <img alt="App icon" className="p-apps_browser__app_icon"
                                             src="https://slack-files2.s3-us-west-2.amazonaws.com/avatars/2018-01-17/300655353986_53957f8929256e832140_72.png" />
                                            <div className="p-apps_browser__app_info">
                                                <div className="p-apps_browser__app_name">
                                                    <strong>Disco</strong>
                                                </div>
                                                <div className="p-apps_browser__app_description">
                                                    Effortless recognition &amp; rewards ⭐️
                                                </div>
                                            </div>
                                            <button
                                                className="c-button c-button--outline c-button--medium p-apps_browser__app_action null--outline null--medium"
                                                type="button">Install
                                            </button>
                                    </div>
                                    <div className="p-apps_browser__app" data-app="true" data-app_id="A355V71K7"
                                         data-app_index="30" data-bot_id="" data-bot_user_id=""
                                         data-is_installed="false" role="presentation">
                                        <img alt="App icon" className="p-apps_browser__app_icon"
                                             src="https://slack-files2.s3-us-west-2.amazonaws.com/avatars/2017-07-31/219779967281_6024f981fe6f5a28b840_72.png" />
                                            <div className="p-apps_browser__app_info">
                                                <div className="p-apps_browser__app_name">
                                                    <strong>StandupIy</strong>
                                                </div>
                                                <div className="p-apps_browser__app_description">
                                                    Standup meetings, surveys &amp; analytics
                                                </div>
                                            </div>
                                            <button
                                                className="c-button c-button--outline c-button--medium p-apps_browser__app_action null--outline null--medium"
                                                type="button">Install
                                            </button>
                                    </div>
                                    <div className="p-apps_browser__app" data-app="true" data-app_id="A0H67RAG0"
                                         data-app_index="31" data-bot_id="" data-bot_user_id=""
                                         data-is_installed="false" role="presentation">
                                        <img alt="App icon" className="p-apps_browser__app_icon"
                                             src="https://slack-files2.s3-us-west-2.amazonaws.com/avatars/2015-12-22/17210675457_7cc116cc1fb03ec9fef6_72.png" />
                                            <div className="p-apps_browser__app_info">
                                                <div className="p-apps_browser__app_name">
                                                    <strong>Geekbot</strong>
                                                </div>
                                                <div className="p-apps_browser__app_description">
                                                    Asynchronous standup meetings in Slack
                                                </div>
                                            </div>
                                            <button
                                                className="c-button c-button--outline c-button--medium p-apps_browser__app_action null--outline null--medium"
                                                type="button">Install
                                            </button>
                                    </div>
                                    <div className="p-apps_browser__app" data-app="true" data-app_id="A11MJ51SR"
                                         data-app_index="32" data-bot_id="" data-bot_user_id=""
                                         data-is_installed="false" role="presentation">
                                        <img alt="App icon" className="p-apps_browser__app_icon"
                                             src="https://slack-files2.s3-us-west-2.amazonaws.com/avatars/2017-09-07/238810648614_7050c90574e7f953aa42_72.png" />
                                            <div className="p-apps_browser__app_info">
                                                <div className="p-apps_browser__app_name">
                                                    <strong>Donut</strong>
                                                </div>
                                                <div className="p-apps_browser__app_description">
                                                    Build relationships by getting matched with a new coffee buddy each
                                                    week
                                                </div>
                                            </div>
                                            <button
                                                className="c-button c-button--outline c-button--medium p-apps_browser__app_action null--outline null--medium"
                                                type="button">Install
                                            </button>
                                    </div>
                                    <div className="p-apps_browser__app" data-app="true" data-app_id="A9WFQ3M0B"
                                         data-app_index="33" data-bot_id="" data-bot_user_id=""
                                         data-is_installed="false" role="presentation">
                                        <img alt="App icon" className="p-apps_browser__app_icon"
                                             src="https://slack-files2.s3-us-west-2.amazonaws.com/avatars/2018-07-23/403895177205_5bba247da24a9129c161_72.png" />
                                            <div className="p-apps_browser__app_info">
                                                <div className="p-apps_browser__app_name">
                                                    <strong>Zendesk</strong>
                                                </div>
                                                <div className="p-apps_browser__app_description">
                                                    View, create, and take action on support tickets from any Slack
                                                    channel
                                                </div>
                                            </div>
                                            <button
                                                className="c-button c-button--outline c-button--medium p-apps_browser__app_action null--outline null--medium"
                                                type="button">Install
                                            </button>
                                    </div>
                                    <div className="p-apps_browser__app" data-app="true" data-app_id="A0F8148C9"
                                         data-app_index="34" data-bot_id="" data-bot_user_id=""
                                         data-is_installed="false" role="presentation">
                                        <img alt="App icon" className="p-apps_browser__app_icon"
                                             src="https://a.slack-edge.com/8a5df/img/plugins/blue_jeans/service_72.png" />
                                            <div className="p-apps_browser__app_info">
                                                <div className="p-apps_browser__app_name">
                                                    <strong>BlueJeans</strong>
                                                </div>
                                                <div className="p-apps_browser__app_description">
                                                    Cloud-based video meetings for any device.
                                                </div>
                                            </div>
                                            <button
                                                className="c-button c-button--outline c-button--medium p-apps_browser__app_action null--outline null--medium"
                                                type="button">Install
                                            </button>
                                    </div>
                                    <div className="p-apps_browser__app" data-app="true" data-app_id="A1FKYAUUX"
                                         data-app_index="35" data-bot_id="" data-bot_user_id=""
                                         data-is_installed="false" role="presentation">
                                        <img alt="App icon" className="p-apps_browser__app_icon"
                                             src="https://slack-files2.s3-us-west-2.amazonaws.com/avatars/2016-06-09/49671169684_cbdc45293ab75ea06413_72.png" />
                                            <div className="p-apps_browser__app_info">
                                                <div className="p-apps_browser__app_name">
                                                    <strong>PagerDuty</strong>
                                                </div>
                                                <div className="p-apps_browser__app_description">
                                                    PagerDuty is your fastest path to incident resolution
                                                </div>
                                            </div>
                                            <button
                                                className="c-button c-button--outline c-button--medium p-apps_browser__app_action null--outline null--medium"
                                                type="button">Install
                                            </button>
                                    </div>
                                    <div className="p-apps_browser__app" data-app="true" data-app_id="A225ZRNF5"
                                         data-app_index="36" data-bot_id="" data-bot_user_id=""
                                         data-is_installed="false" role="presentation">
                                        <img alt="App icon" className="p-apps_browser__app_icon"
                                             src="https://slack-files2.s3-us-west-2.amazonaws.com/avatars/2016-08-23/72063725475_a79d7c6a48b314c85772_72.png" />
                                            <div className="p-apps_browser__app_info">
                                                <div className="p-apps_browser__app_name">
                                                    <strong>HBR</strong>
                                                </div>
                                                <div className="p-apps_browser__app_description">
                                                    Get content from Harvard Business Review delivered to Slack.
                                                </div>
                                            </div>
                                            <button
                                                className="c-button c-button--outline c-button--medium p-apps_browser__app_action null--outline null--medium"
                                                type="button">Install
                                            </button>
                                    </div>
                                    <div className="p-apps_browser__app" data-app="true" data-app_id="A0T3W4EAX"
                                         data-app_index="37" data-bot_id="" data-bot_user_id=""
                                         data-is_installed="false" role="presentation">
                                        <img alt="App icon" className="p-apps_browser__app_icon"
                                             src="https://slack-files2.s3-us-west-2.amazonaws.com/avatars/2018-01-12/297532298896_b38db12dd15a4aebf3d1_72.png" />
                                            <div className="p-apps_browser__app_info">
                                                <div className="p-apps_browser__app_name">
                                                    <strong>Troops</strong>
                                                </div>
                                                <div className="p-apps_browser__app_description">
                                                    Update Salesforce, Create Alerts, Use Your Salesforce Reports in
                                                    Slack 🚀 📈
                                                </div>
                                            </div>
                                            <button
                                                className="c-button c-button--outline c-button--medium p-apps_browser__app_action null--outline null--medium"
                                                type="button">Install
                                            </button>
                                    </div>
                                </section>
                                <div
                                    className="c-infinite_spinner p-apps_browser__spinner c-infinite_spinner--jumbo c-infinite_spinner--blue">
                                    <svg className="c-infinite_spinner__spinner" viewBox="0 0 100 100">
                                        <circle className="c-infinite_spinner__bg" cx="50%" cy="50%" r="35" />
                                        <circle className="c-infinite_spinner__path" cx="50%" cy="50%" r="35" />
                                    </svg>
                                    <svg className="c-infinite_spinner__spinner c-infinite_spinner__tail"
                                         viewBox="0 0 100 100">
                                        <circle className="c-infinite_spinner__path" cx="50%" cy="50%" r="35" />
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        );
    }
}

ContentsContainer.propTypes = {
    /** myProp */
    //myProp: PropTypes.string.isRequired
};

ContentsContainer.defaultProps = {
    //myProp: val
};

export default ContentsContainer;