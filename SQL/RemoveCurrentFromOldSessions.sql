-- Assumption: Only one session can be added at a time.
CREATE TRIGGER RemoveCurrentFromOldSessions
BEFORE INSERT ON Session
FOR EACH ROW
	UPDATE Session
    SET IsCurrent = 0
    
