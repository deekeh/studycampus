## Database Structure
### Syntax

- level/name
  - sub_level/name
    - sub_sub_level/name datatype
---

### Structure
- database/studycampus
  - table/user
    - column/email varchar(50)
	- column/id auto_increment bigint(10)
	- column/name varchar(40)
	- column/password text
	- column/type tinyint(1)
  - table/enrolled_course
    - column/course_id int(10)
	- column/course_id int(10)
  - table/course
    - column/id auto_increment int(11)
	- column/name varchar(100)
	- column/description text
	- column/uploader_id int(11)
	- column/upload_date timestamp DEFAULT-current_timestamp
  - table/video
    - column/id auto_increment int(10)
	- column/name text
	- column/course_id int(10)
	- column/url varchar(500)
  - table/video_topic_breakpoint
    - column/video_id int(10)
	- column/start double
	- column/end double
	- column/topic_name varchar(100)
	- column/resource_url varchar(300)
  - video_pause
    - column/user_id int(10)
	- column/video_id int(10)
	- column/video_time int(100)
