CREATE TABLE Role
(
    RoleID    INTEGER,
    RoleName  VARCHAR(20)     NOT NULL,
    
    PRIMARY KEY (RoleID)
);

CREATE TABLE PassedSpeakResponse
(
    ResponseID      INTEGER,
    Label           VARCHAR(30),
    
    PRIMARY KEY(ResponseID)
);

CREATE TABLE User
(
    UserID          INT             AUTO_INCREMENT,
    Username        VARCHAR(20),
    Password        VARCHAR(20)     NOT NULL,
    FirstName       VARCHAR(20),
    LastName        VARCHAR(20),
    EmailAddress    VARCHAR(40),
    RoleID          INTEGER,
    
    PRIMARY KEY     (UserID),
    UNIQUE          (Username),
    FOREIGN KEY     (RoleID)    REFERENCES Role(RoleID)
);

-- GC member account information is saved in the User table.
CREATE TABLE Session
(
    SessionID               VARCHAR(10),
    NominationDeadline      DATETIME,
    ResponseDeadline        DATETIME,
    VerificationDeadline    DATETIME,
    GCChairID               INT,
    IsCurrent               TINYINT(1),
        
    PRIMARY KEY (SessionID),
    FOREIGN KEY (GCChairID) REFERENCES User(UserID)
);

-- Assumption: A nominee cannot have two nominators during the same session.
CREATE TABLE NominationForm
(
    SessionID               VARCHAR(10),
    PID                     VARCHAR(10),
    NominatorID             INT             NOT NULL,
    FirstName               VARCHAR(20)     NOT NULL,
    LastName                VARCHAR(20)     NOT NULL,
    EmailAddress            VARCHAR(40)     NOT NULL,
    Ranking                 INTEGER,
    IsCSGradStudent         TINYINT(1),
    IsNewGradStudent        TINYINT(1),
    ApplicationReceived     TINYINT(1),
    ApplicationVerified     TINYINT(1),
    Timestamp               DATETIME,

    PRIMARY KEY (SessionID, PID),
    FOREIGN KEY (SessionID)         REFERENCES Session(SessionID),
    FOREIGN KEY (NominatorID)       REFERENCES User(UserID)
);

-- If a nominee ever needs to update his info form, the corresponding 
-- verification record must be deleted.
-- Also, if the nominee chooses to update his FirstName, LastName or
-- IsCSGradStudent attributes, the update must be performed on the corresponding
-- NominationForm row. The timestamp of that row should not be updated.
CREATE TABLE NomineeInfoForm
(
    SessionID               VARCHAR(10),
    PID                     VARCHAR(10),
    PhoneNumber             VARCHAR(10),
    AdvisorFirstName        VARCHAR(20),
    AdvisorLastName         VARCHAR(20),
    NumberOfSemestersAsGTA  INTEGER,
    PassedSpeak             INTEGER,
    GPA                     REAL,
    Timestamp               DATETIME        NOT NULL,  

    PRIMARY KEY (SessionID, PID),
    FOREIGN KEY (SessionID, PID) REFERENCES NominationForm(SessionID, PID),
    FOREIGN KEY (PassedSpeak)    REFERENCES PassedSpeakResponse(ResponseID)
);

CREATE TABLE PreviousAdvisorRecord
(
    SessionID           VARCHAR(10),
    PID                 VARCHAR(10),
    StartDate           DATETIME,
    EndDate             DATETIME,
    AdvisorFirstName    VARCHAR(20)     NOT NULL,
    AdvisorLastName     VARCHAR(20)     NOT NULL,
    
    -- Assumption: A nominee cannot have two advisors during same time period
    PRIMARY KEY (SessionID, PID, StartDate, EndDate),
    FOREIGN KEY (SessionID, PID) REFERENCES NomineeInfoForm(SessionID, PID)
);

CREATE TABLE CourseRecord
(
    SessionID           VARCHAR(10),
    PID                 VARCHAR(10),
    CourseName          VARCHAR(10),
    Grade               VARCHAR(2)      NOT NULL,
    
    PRIMARY KEY (SessionID, PID, CourseName),
    FOREIGN KEY (SessionID, PID) REFERENCES NomineeInfoForm(SessionID, PID)   
);

CREATE TABLE PublicationRecord
(
    SessionID           VARCHAR(10),
    PID                 VARCHAR(10),
    Title               VARCHAR(100),
    Citation            VARCHAR(1000),
    
    PRIMARY KEY (SessionID, PID, Title),
    FOREIGN KEY (SessionID, PID) REFERENCES NomineeInfoForm(SessionID, PID)  
);

/*
    Nominator verifies nominees inputted data
 */
CREATE TABLE VerificationRecord
(
    SessionID           VARCHAR(10),
    PID                 VARCHAR(10),
    Timestamp           DATETIME        NOT NULL,

    PRIMARY KEY (SessionID, PID),
    FOREIGN KEY (SessionID, PID) REFERENCES NomineeInfoForm(SessionID, PID)
);

CREATE TABLE Score
(
    SessionID           VARCHAR(10),
    PID                 VARCHAR(10),
    GCMemberID          INT,
    Comment             VARCHAR(1000),
    Score               INTEGER,
    CHECK (Score >= 1 AND Score <= 100),
    
    PRIMARY KEY (SessionID, PID, GCMemberID),
    FOREIGN KEY (SessionID, PID)    REFERENCES NominationForm(SessionID, PID),
    FOREIGN KEY (GCMemberID)        REFERENCES User(UserID)
);

CREATE TABLE GCMembersInSession
(
    SessionID           VARCHAR(10),
	GCMemberID	        INT,
    
    PRIMARY KEY (SessionID, GCMemberID),
    FOREIGN KEY (SessionID)     REFERENCES Session(SessionID)
        ON DELETE CASCADE,
    FOREIGN KEY (GCMemberID)    REFERENCES User(UserID)
);