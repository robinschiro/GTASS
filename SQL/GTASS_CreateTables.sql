-- Schema for GTASS

CREATE TABLE Role
(
    RoleID  INTEGER,
    Name    VARCHAR(20)     NOT NULL,
    
    PRIMARY KEY (RoleID)
)

CREATE TABLE PassedSpeakResponse
(
    ResponseID      INTEGER,
    Label           VARCHAR(30),
    
    PRIMARY KEY(ResponseID)
)

CREATE TABLE User
(
    Username        VARCHAR(20),
    Password        VARCHAR(20)     NOT NULL,
    FirstName       VARCHAR(20),
    LastName        VARCHAR(20),
    EmailAddress    VARCHAR(40),
    RoleID          INTEGER,
    
    PRIMARY KEY     (Username),
    UNIQUE          (PID),
    FOREIGN KEY     (RoleID)    REFERENCES Role(RoleID)
)

CREATE TABLE Nominee
(
    Username                VARCHAR(20),
    PID                     VARCHAR(10),
    PhoneNumber             VARCHAR(10),
    AdvisorFirstName        VARCHAR(20),
    AdvisorLastName         VARCHAR(20),
    IsCSGradStudent         BIT,
    NumberOfSemestersAsGTA  INTEGER,
    PassedSpeak             INTEGER,
    GPA                     REAL,

    PRIMARY KEY (Username),
    FOREIGN KEY (Username)      REFERENCES User(Username),
    FOREIGN KEY (PassedSpeak)   REFERENCES PassedSpeakResponse(ResponseID)
)

CREATE TABLE PreviousAdvisorRecord
(
    NomineeUsername     VARCHAR(20),
    StartDate           DATETIME,
    EndDate             DATETIME,
    AdvisorFirstName    VARCHAR(20)     NOT NULL,
    AdvisorLastName     VARCHAR(20)     NOT NULL,
    
    -- Assumption: A nominee cannot have two advisors during same time period
    PRIMARY KEY (NomineeUsername, StartDate, EndDate),
    FOREIGN KEY (NomineeUsername) REFERENCES Nominee (Username)    
)

CREATE TABLE CourseRecord
(
    NomineeUsername     VARCHAR(20),
    CourseName          VARCHAR(10),
    Grade               VARCHAR(2)      NOT NULL,
    
    PRIMARY KEY (NomineeUsername, CourseName),
    FOREIGN KEY (NomineeUsername) REFERENCES Nominee (Username)    
)

CREATE TABLE PublicationRecord
(
    NomineeUsername     VARCHAR(20),
    Title               VARCHAR(100),
    Citation            VARCHAR(MAX)
    
    PRIMARY KEY (NomineeUsername, Title),
    FOREIGN KEY (NomineeUsername) REFERENCES Nominee (Username)    
)

-- The Nominee's PID is not a foreign key because the nominee may not have a 
-- user account yet. If the Nominee's PID (and thus user details) is in the 
-- system, the associated user information will not be needed ( that is, the
-- fields will already be filled in).
CREATE TABLE NominationForm
(
    -- The FormID will be auto-incremented for each entry in the table.
    FormID                  INTEGER,
    NominatorUsername       VARCHAR(20)     NOT NULL,
    PID                     VARCHAR(10)     NOT NULL,                
    FirstName               VARCHAR(20)     NOT NULL,
    LastName                VARCHAR(20)     NOT NULL,
    EmailAddress            VARCHAR(40)     NOT NULL,
    Ranking                 INTEGER,
    IsCSGradStudent         BIT,
    IsNewGradStudent        BIT,
    Timestamp               DATETIME,

    PRIMARY KEY (FormID),
    FOREIGN KEY (NominatorUsername) REFERENCES User(Username)   
)

-- When the nominee is emailed for the first time, he will be prompted to 
-- create a user account. The information inputted by the nominator will serve
-- as default values when creating the account. Once the account has been
-- created, the user will be redirected to the info form. Several fields of the 
-- info form will be filled with details from the nominee's account. Modified
-- field are saved to the corresponding entry in the 'Nominee' table.
CREATE TABLE NomineeInfoForm
(
    -- The FormID will be auto-incremented for each entry in the table.
    FormID                  INTEGER,
    NominatorUsername       VARCHAR(20),
    NomineeUsername         VARCHAR(20),
    Timestamp               DATETIME        NOT NULL,            
    
    PRIMARY KEY (FormID),
    FOREIGN KEY (NominatorUsername) REFERENCES User (Username)
)