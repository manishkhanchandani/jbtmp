<?php

namespace Jobs\ServiceBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * JobsKeywords
 */
class JobsKeywords
{
    /**
     * @var string
     */
    private $jobId;

    /**
     * @var string
     */
    private $keyword;


    /**
     * Set jobId
     *
     * @param string $jobId
     * @return JobsKeywords
     */
    public function setJobId($jobId)
    {
        $this->jobId = $jobId;
    
        return $this;
    }

    /**
     * Get jobId
     *
     * @return string 
     */
    public function getJobId()
    {
        return $this->jobId;
    }

    /**
     * Set keyword
     *
     * @param string $keyword
     * @return JobsKeywords
     */
    public function setKeyword($keyword)
    {
        $this->keyword = $keyword;
    
        return $this;
    }

    /**
     * Get keyword
     *
     * @return string 
     */
    public function getKeyword()
    {
        return $this->keyword;
    }
}
