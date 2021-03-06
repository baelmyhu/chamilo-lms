<div id="about-session">
    <div class="row">
        <div class="col-xs-12">
            <p>
                <em class="fa fa-clock-o" aria-hidden="true"></em>
                {% if session.duration %}
                    <em>{{ 'SessionDurationXDaysLeft'|get_lang|format(session.duration) }}</em>
                {% else %}
                    <em>{{ session_date.display }}</em>
                {% endif %}
            </p>
            {% if show_tutor %}
                <p>
                    <em class="fa fa-user"></em> {{ 'SessionGeneralCoach'|get_lang }}: <em>{{ session.generalCoach.getCompleteName() }}</em>
                </p>
            {% endif %}

            {% if session.getShowDescription() %}
                <div class="lead">
                    {{ session.getDescription() }}
                </div>
            {% endif %}
        </div>
    </div>

    {% if has_requirements %}
        <div class="row">
            <div class="col-xs-12">
                <div class="panel panel-default">
                    <div class="panel-heading">{{ 'RequiredSessions'|get_lang }}</div>
                    <div class="panel-body">
                        <div class="row">
                            {% for sequence in sequences %}
                                <div class="col-md-4">
                                    <dl class="dl-horizontal">
                                        {% if sequence.requirements %}
                                            <dt>{{ sequence.name }}</dt>
                                            {% for requirement in sequence.requirements %}
                                                <dd>
                                                    <a href="{{ _p.web ~ 'session/' ~ requirement.getId ~ '/about/' }}">
                                                        {{ requirement.getName }}
                                                    </a>
                                                </dd>
                                            {% endfor %}
                                        {% endif %}
                                    </dl>
                                </div>
                            {% endfor %}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    {% endif %}

    {% if is_subscribed and user_session_time != -0 and user_session_time >= 1 %}
        <div class="alert alert-info">
            {{ 'AlreadyRegisteredToSession'|get_lang }}
        </div>
    {% elseif is_subscribed and user_session_time < 1 %}
        <div class="alert alert-warning">
            {{ 'YourSessionTimeIsExpired'|get_lang }}
        </div>
    {% endif %}

    {% for course_data in courses %}
        {% set course_video = '' %}

        {% for extra_field in course_data.extra_fields %}
            {% if extra_field.value.getField().getVariable() == 'video_url' %}
                {% set course_video = extra_field.value.getValue() %}
            {% endif %}
        {% endfor %}
        <div class="panel-course">
            <div class="row">
                {% if courses|length > 1 %}
                    <div class="col-xs-12">
                        <h3 class="text-uppercase">{{ course_data.course.getTitle }}</h3>
                    </div>
                {% endif %}

                {% if course_video %}
                    <div class="col-sm-6 col-md-7">
                        <div class="embed-responsive embed-responsive-16by9">
                            {{ essence.replace(course_video) }}
                        </div>
                    </div>
                {% endif %}

                <div class="{{ course_video ? 'col-sm-6 col-md-5' : 'col-sm-12' }}">
                    <div class="description-course">
                        {{ course_data.description.getContent }}
                    </div>
                </div>
            </div>
        </div>

        <div class="row info-course">
            <div class="col-xs-12 col-md-7">
                <div class="panel panel-default panel-information">
                    <div class="panel-heading">
                        <h4>{{ "CourseInformation"|get_lang }}</h4>
                    </div>
                    <div class="panel-body">
                        {% if course_data.objectives %}
                            <div class="objective-course">
                                <h4 class="title-info"><em class="fa fa-book"></em> {{ course_data.objectives.getTitle }}</h4>
                                <div class="content-info">
                                    {{ course_data.objectives.getContent }}
                                </div>
                            </div>
                        {% endif %}

                        {% if course_data.topics %}
                            <div class="topics">
                                <h4 class="title-info"><em class="fa fa-book"></em> {{ course_data.topics.getTitle }}</h4>
                                <div class="content-info">
                                    {{ course_data.topics.getContent }}
                                </div>
                            </div>
                        {% endif %}

                        {% if course_data.methodology %}
                            <div class="topics">
                                <h4 class="title-info"><em class="fa fa-book"></em> {{ course_data.methodology.getTitle }}</h4>
                                <div class="content-info">
                                    {{ course_data.methodology.getContent }}
                                </div>
                            </div>
                        {% endif %}

                        {% if course_data.material %}
                            <div class="topics">
                                <h4 class="title-info"><em class="fa fa-book"></em> {{ course_data.material.getTitle }}</h4>
                                <div class="content-info">
                                    {{ course_data.material.getContent }}
                                </div>
                            </div>
                        {% endif %}

                        {% if course_data.resources %}
                            <div class="topics">
                                <h4 class="title-info"><em class="fa fa-book"></em> {{ course_data.resources.getTitle }}</h4>
                                <div class="content-info">
                                    {{ course_data.resources.getContent }}
                                </div>
                            </div>
                        {% endif %}

                        {% if course_data.assessment %}
                            <div class="topics">
                                <h4 class="title-info"><em class="fa fa-book"></em> {{ course_data.assessment.getTitle }}</h4>
                                <div class="content-info">
                                    {{ course_data.assessment.getContent }}
                                </div>
                            </div>
                        {% endif %}

                        {% if course_data.custom %}
                            {% for custom in course_data.custom %}
                                <div class="topics">
                                    <h4 class="title-info"><em class="fa fa-book"></em> {{ custom.getTitle }}</h4>
                                    <div class="content-info">
                                        {{ custom.getContent }}
                                    </div>
                                </div>
                            {% endfor %}
                        {% endif %}
                    </div>
                </div>
            </div>

            <div class="col-xs-12 col-md-5">
                {% if course_data.coaches %}
                    <div class="panel panel-default panel-teachers">
                        <div class="panel-heading">
                            <h4>{{ "Coaches"|get_lang }}</h4>
                        </div>
                        <div class="panel-body">
                            {% for coach in course_data.coaches %}
                                <div class="coach-information">
                                    <div class="coach-avatar">
                                        <img class="img-circle img-responsive" src="{{ coach.image }}" alt="{{ coach.complete_name }}">
                                    </div>
                                    <h4>{{ coach.complete_name }}</h4>
                                    {% for extra_field in coach.extra_fields %}
                                        <dl class="coach-extrafield">
                                            <dt class="extrafield_dt dt_{{extra_field.value.getField().getVariable()}}">{{ extra_field.value.getField().getDisplayText() }}</dt>
                                            <dd class="extrafield_dd dd_{{extra_field.value.getField().getVariable()}}">{{ extra_field.value.getValue() }}</dd>
                                        </dl>
                                    {% endfor %}
                                </div>
                            {% endfor %}
                        </div>
                    </div>
                {% endif %}

                {% if course_data.tags %}
                    <div class="panel panel-default panel-tags">
                        <div class="panel-heading"><h4>{{ 'Tags'|get_lang }}</h4></div>
                        <div class="panel-body">
                            <ul class="list-inline course-tags">
                                {% for tag in course_data.tags %}
                                    <li class="tag-value">
                                        <span>{{ tag.getTag }}</span>
                                    </li>
                                {% endfor %}
                            </ul>
                        </div>
                    </div>
                {% endif %}

                <div class="panel panel-default panel-social">
                    <div class="panel-heading"><h4>{{ "ShareWithYourFriends"|get_lang }}</h4></div>
                    <div class="panel-body">
                        <div class="socialshare">
                            <ul class="networks">
                                <li>
                                    <a href="https://www.facebook.com/sharer/sharer.php?{{ {'u': page_url }|url_encode }}" target="_blank" class="btn bnt-link btn-lg">
                                        <em class="fa fa-facebook"></em>
                                    </a>
                                </li>
                                <li>
                                    <a href="https://twitter.com/home?{{ {'status': session.getName() ~ ' ' ~ page_url }|url_encode }}" target="_blank" class="btn bnt-link btn-lg">
                                        <em class="fa fa-twitter"></em>
                                    </a>
                                </li>
                                <li>
                                    <a href="https://www.linkedin.com/shareArticle?{{ {'mini': 'true', 'url': page_url , 'title': session.getName() }|url_encode }}" target="_blank" class="btn bnt-link btn-lg">
                                        <em class="fa fa-linkedin"></em>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                {% if is_premiun == false %}
                <div class="panel panel-default panel-subscription">
                    <div class="panel-heading">
                        <h4>{{ 'CourseSubscription'|get_lang }}</h4>
                    </div>
                    <div class="panel-body">
                        <div class="panel-subscribe text-center">
                        {% if _u.logged and not is_subscribed %}
                            {{ subscribe_button }}
                        {% elseif not _u.logged %}
                            {% if 'allow_registration'|api_get_setting != 'false' %}
                                <a href="{{ _p.web_main ~ 'auth/inscription.php' ~ redirect_to_session }}" class="btn btn-success btn-block btn-lg">
                                    <i class="fa fa-pencil" aria-hidden="true"></i> {{ 'SignUp'|get_lang }}
                                </a>
                            {% endif %}
                        {% endif %}
                        </div>
                    </div>
                </div>
                {% else %}
                <div class="panel panel-default">
                    <div class="panel-heading">
                        {{ 'SalePrice'|get_lang }}
                    </div>
                    <div class="panel-body">
                        <div class="price-text">
                            {{ is_premiun.iso_code }} {{ is_premiun.price }}
                        </div>
                        <div class="buy-box">
                            <a href="{{ _p.web }}plugin/buycourses/src/process.php?i={{ is_premiun.product_id }}&t={{ is_premiun.product_type }}" class="btn btn-lg btn-primary btn-block">{{ 'BuyNow'|get_lang }}</a>
                        </div>
                    </div>
                </div>
                {% endif %}
            </div>
        </div>
    {% endfor %}
</div>
