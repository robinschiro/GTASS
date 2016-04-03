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
    Username        VARCHAR(20),
    Password        VARCHAR(20)     NOT NULL,
    FirstName       VARCHAR(20),
    LastName        VARCHAR(20),
    EmailAddress    VARCHAR(40),
    RoleID          INTEGER,
    IsActive        BIT,
    
    PRIMARY KEY     (Username),
    FOREIGN KEY     (RoleID)    REFERENCES Role(RoleID)
);

-- GC member account information is saved in the User table.
CREATE TABLE Session
(
    SessionID               VARCHAR(10),
    NominationDeadline      DATETIME,
    ResponseDeadline        DATETIME,
    VerificationDeadline    DATETIME,
    GCChairUsername         VARCHAR(20),
    IsCurrent               BIT,
        
    PRIMARY KEY (SessionID),
    FOREIGN KEY (GCChairUsername) REFERENCES User(Username)
);

-- Assumption: A nominee cannot have two nominators during the same session.
CREATE TABLE NominationForm
(
    SessionID               VARCHAR(10),
    PID                     VARCHAR(10),
    NominatorUsername       VARCHAR(20)     NOT NULL,
    FirstName               VARCHAR(20)     NOT NULL,
    LastName                VARCHAR(20)     NOT NULL,
    EmailAddress            VARCHAR(40)     NOT NULL,
    Ranking                 INTEGER,
    IsCSGradStudent         BIT,
    IsNewGradStudent        BIT,
    Timestamp               DATETIME,

    PRIMARY KEY (SessionID, PID),
    FOREIGN KEY (SessionID)         REFERENCES Session(SessionID),
    FOREIGN KEY (NominatorUsername) REFERENCES User(Username)
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
    GCUsername          VARCHAR(20),
    Comment             VARCHAR(1000),
    Score               INTEGER,
    CHECK (Score >= 1 AND Score <= 100),
    
    PRIMARY KEY (SessionID, PID, GCUsername),
    FOREIGN KEY (SessionID, PID)    REFERENCES NominationForm(SessionID, PID),
    FOREIGN KEY (GCUsername)        REFERENCES User(Username)
);

CREATE TABLE GCMembersInSession
(
    SessionID           VARCHAR(10),
	GCUserName	        VARCHAR(20),
    
    PRIMARY KEY (SessionID, GCUsername),
    FOREIGN KEY (SessionID)     REFERENCES Session(SessionID)
        ON DELETE CASCADE,
    FOREIGN KEY (GCUsername)    REFERENCES User(Username)
);