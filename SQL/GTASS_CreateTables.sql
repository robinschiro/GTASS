-- Schema for GTASS

CREATE TABLE Role
(
    RoleID    INTEGER,
    RoleName  VARCHAR(20)     NOT NULL,
    
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

    PRIMARY KEY (Username)      REFERENCES User(Username),
    UNIQUE      (PID)),
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

-- GC member account information is saved in the User table.
CREATE TABLE Session
(
    SessionID               VARCHAR(10),
    NominationDeadline      DATETIME,
    ResponseDeadline        DATETIME,
    VerificationDeadline    DATETIME,
    GCChairUsername         VARCHAR(20),
        
    PRIMARY KEY (SessionID),
    FOREIGN KEY (GCChairUsername) REFERENCES User(Username)
)


-- The Nominee's PID is not a foreign key because the nominee may not have a 
-- user account yet. If the Nominee's PID (and thus user details) is in the 
-- system, the associated user information will not be needed ( that is, the
-- fields will already be filled in).
CREATE TABLE NominationForm
(
    SessionID               INTEGER,
    NominatorUsername       VARCHAR(20)     NOT NULL,
    PID                     VARCHAR(10)     NOT NULL,                
    FirstName               VARCHAR(20)     NOT NULL,
    LastName                VARCHAR(20)     NOT NULL,
    EmailAddress            VARCHAR(40)     NOT NULL,
    Ranking                 INTEGER,
    IsCSGradStudent         BIT,
    IsNewGradStudent        BIT,
    Timestamp               DATETIME,

    PRIMARY KEY (SessionID, NominatorUsername, PID),
    FOREIGN KEY (SessionID) REFERENCES Session(SessionID),
    FOREIGN KEY (NominatorUsername) REFERENCES User(Username)
)

-- When the nominee is emailed for the first time, he will be prompted to 
-- create a user account. The information inputted by the nominator will serve
-- as default values when creating the account. Once the account has been
-- created, the user will be redirected to the info form. Several fields of the 
-- info form will be filled with details from the nominee's account. Modified
-- fields are saved to the corresponding entry in the 'Nominee' table.
CREATE TABLE NomineeInfoForm
(
    SessionID               INTEGER,
    NominatorUsername       VARCHAR(20),
    NomineeUsername         VARCHAR(20),
    Timestamp               DATETIME        NOT NULL,            
    
    PRIMARY KEY (SessionID, NominatorUsername, NomineeeUsername),
    FOREIGN KEY (SessionID)         REFERENCES Session(SessionID),
    FOREIGN KEY (NominatorUsername) REFERENCES User(Username),
    FOREIGN KEY (NomineeeUsername)  REFERENCES Nominee(Username)
)


CREATE TABLE Score
(
    SessionID           VARCHAR(10),
    GCUsername          VARCHAR(20),
    NomineeeUsername    VARCHAR(20),
    Score               INTEGER,
    CHECK (Score >= 1) AND (Score <= 100),
    
    PRIMARY KEY (SessionID, GCUsername, NomineeUsername),
    FOREIGN KEY (SessionID)         REFERENCES Session(SessionID),
    FOREIGN KEY (GCUsername)        REFERENCES User(Username),
    FOREIGN KEY (NomineeeUsername)  REFERENCES Nominee(Username)
)










