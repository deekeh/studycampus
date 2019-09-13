## Database Structure
### Syntax

- level/name
  - sub_level/name
    - sub_sub_level/name
---

### Structure
- database/studycampus
  - table/user
    - column/email
	- column/id
	- column/name
	- column/password
	- column/type
  - table/enrolled_course
    - column/course_id
	- column/course_id
  - table/course
    - column/id
	- column/name
	- column/description
	- column/uploader_id
	- column/upload_date
  - table/video
    - column/id
	- column/name
	- column/course_id
	- column/url
  - table/video_breakpoint
    - column/video_id
	- column/start
	- column/end
	- column/topic_name
	- column/resource_url
  - video_pause
    - column/user_id
	- column/video_id
	- column/video_time
